<?php
namespace App\User\Controllers;

use App\Core\Exceptions\FormException;
use App\Core\Renderer\TwigRenderer;
use App\User\Entity\User;
use App\User\Form\RegisterType;
use App\User\Services\RegisterService;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\Form\FormFactory;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\RedirectResponse;

class RegisterController
{
    public function __construct(
        FormFactory $form_factory,
        TwigRenderer $render,
        RegisterService $register_service
    ){
        $this->render = $render;
        $this->form_factory = $form_factory;
        $this->register_service = $register_service;
    }

    public function register(ServerRequestInterface $request)
    {
        $user = new User();
        $error = null;

        //get form
        $form = $this->form_factory->createBuilder(
            RegisterType::class, $user,
            ['action' => '?submit']
        )->getForm();

        $form->handleRequest(symfonyRequest($request));

        //handle form validation
        if($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            try {
                $this->register_service->register($user);
                return new RedirectResponse('/');
            } catch(FormException $e) {
                $error = $e->getMessage();
            }
        }

        $response = new Response();
        $response->getBody()->write($this->render->render('@user/register.html.twig', [
            'form' => $form->createView(),
            'error' => $error
        ]));

        return $response;
    }
}