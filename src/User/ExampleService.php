<?php
namespace App\User;

use Doctrine\ORM\EntityManager;
use App\User\Entity\User;

class ExampleService
{
    private $entity;

    public function __construct(EntityManager $entity)
    {
        $this->entity = $entity;
    }

    public function showEmail($username)
    {

        $user = $this->entity->getRepository(User::class)->findOneBy(['username' => $username]);
        if($user) {
            return $user->getEmail();
        }

        return null;
    }
}