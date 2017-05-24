<?php
namespace App\User\Actions;

use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ServerRequestInterface;
use App\Core\Renderer\TwigRenderInterface;
use App\User\Entity\User;
use App\User\ExampleService;
use Zend\Diactoros\Response;

class RegisterAction
{
    private $view;

    private $entity;

    public function __construct(TwigRenderInterface $view, EntityManager $entity, ExampleService $example_service)
    {
        $this->view = $view;
        $this->entity = $entity;
        $this->example_service = $example_service;
    }

    public function process(ServerRequestInterface $request, $username = null)
    {
//        var_dump($username);
        $response = new Response();
        $response->getBody()->write($this->view->render('user/register.twig'));

        $test = $this->entity->getRepository(User::class)->findAll();
        var_dump($test);

        var_dump($this->example_service->showEmail('lamonte'));

        return $response;
    }
}