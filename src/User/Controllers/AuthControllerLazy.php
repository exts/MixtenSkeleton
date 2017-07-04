<?php
namespace App\User\Controllers;

use App\Core\Exceptions\FormException;
use App\User\Entity\User;
use App\User\Form\LoginType;
use App\User\Services\AuthenticationService;
use Mixten\Controller\LazyController;
use Mixten\Controller\Traits\RedirectResponse;
use Mixten\Controller\Traits\TwigRender;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\Form\FormFactory;

/**
 * Class AuthController
 *
 * @package App\User\Controllers
 */
class AuthControllerLazy extends LazyController
{
    use TwigRender;
    use RedirectResponse;

    /**
     * @param ServerRequestInterface $request
     *
     * @return ResponseInterface
     */
    public function login(ServerRequestInterface $request)
    {
        $user = new User();
        $error = null;

        //get form
        $form = $this->get(FormFactory::class)->createBuilder(
            LoginType::class, $user, ['action' => '?submit']
        )->getForm();

        $form->handleRequest(symfonyRequest($request));

        if($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            try {
                $this->get(AuthenticationService::class)->login($user, $request);
                return $this->redirect('/dashboard');
            } catch(FormException $e) {
                $error = $e->getMessage();
            }
        }

        return $this->render('@user/login.html.twig', [
            'form' => $form->createView(),
            'error' => $error
        ]);
    }

    /**
     * @return ResponseInterface
     */
    public function logout()
    {
        $this->get(AuthenticationService::class)->logout();

        return $this->redirect('/login');
    }
}
