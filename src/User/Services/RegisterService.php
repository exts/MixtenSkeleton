<?php
namespace App\User\Services;

use App\Core\Exceptions\FormException;
use App\User\Entity\User;
use App\User\Repository\UserRepository;
use Doctrine\ORM\EntityManager;

/**
 * Class RegisterService
 *
 * @package App\User\Services
 */
class RegisterService
{
    /**
     * RegisterService constructor.
     *
     * @param EntityManager $entity_manager
     */
    public function __construct(EntityManager $entity_manager)
    {
        $this->entity_manager = $entity_manager;
    }

    /**
     * @param User $user
     */
    public function register(User $user)
    {
        $this->validateUser($user);

        $this->entity_manager->persist($user);
        $this->entity_manager->flush();
    }

    /**
     * @param User $user
     *
     * @throws FormException
     */
    private function validateUser(User $user)
    {
        if($this->getUserRepository()->usernameExists($user->getUsername())) {
            throw new FormException(sprintf("Username/Email Address already exists"));
        }

        if($this->getUserRepository()->emailExists($user->getEmail())) {
            throw new FormException(sprintf("Username/Email Address already exists"));
        }
    }

    /**
     * @return UserRepository
     */
    private function getUserRepository() : UserRepository
    {
        /** @var UserRepository $repo */
        $repo = $this->entity_manager->getRepository(User::class);

        return $repo;
    }
}