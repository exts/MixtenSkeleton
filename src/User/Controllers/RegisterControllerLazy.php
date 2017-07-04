<?php
namespace App\User\Controllers;

use App\Core\Exceptions\FormException;
use App\User\Entity\User;
use App\User\Form\RegisterType;
use App\User\Services\RegisterService;
use Mixten\Controller\LazyController;
use Mixten\Controller\Traits\RedirectResponse;
use Mixten\Controller\Traits\TwigRender;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\Form\FormFactory;

/**
 * Class RegisterControllerLazy
 *
 * @package App\User\Controllers
 */
class RegisterControllerLazy extends LazyController
{
    use TwigRender;
    use RedirectResponse;

    /**
     * @param ServerRequestInterface $request
     *
     * @return ResponseInterface
     */
    public function register(ServerRequestInterface $request)
    {
        $user = new User();
        $error = null;

        //get form
        $form = $this->get(FormFactory::class)->createBuilder(
            RegisterType::class, $user, ['action' => '?submit']
        )->getForm();

        $form->handleRequest(symfonyRequest($request));

        //handle form validation
        if($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            try {
                $this->get(RegisterService::class)->register($user);
                return $this->redirect('/login');
            } catch(FormException $e) {
                $error = $e->getMessage();
            }
        }

        return $this->render('@user/register.html.twig', [
            'form' => $form->createView(),
            'error' => $error
        ]);
    }
}