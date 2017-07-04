<?php
namespace App\User\Services;

use App\Core\Exceptions\FormException;
use App\User\Entity\User;
use App\User\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Class AuthenticationService
 *
 * @package App\User\Services
 */
class AuthenticationService
{
    /**
     * AuthenticationService constructor.
     *
     * @param Session $session
     * @param EntityManager $entity_manager
     */
    public function __construct(Session $session, EntityManager $entity_manager)
    {
        $this->session = $session;
        $this->entity_manager = $entity_manager;
    }

    /**
     * @param User $user
     * @param ServerRequestInterface $request
     */
    public function login(User $user, ServerRequestInterface $request)
    {
        $this->validateUser($user);

        //authenticate user
        $this->session->set('user/auth', [
            'username' => $user->getUsername(),
            'ip_address' => $request->getServerParams()['REMOTE_ADDR'] ?? '0.0.0.0',
            'user_agent' => $request->getServerParams()['HTTP_USER_AGENT'] ?? null,
        ]);
    }

    /**
     * @return void
     */
    public function logout()
    {
        $this->session->remove('user/auth');
    }

    /**
     * @param User $user
     *
     * @throws FormException
     */
    private function validateUser(User $user)
    {
        /** @var User $matches */
        $matches = $this->getUserRepository()->findOneBy(['username' => $user->getUsername()]);
        if(empty($matches)) {
            throw new FormException("Username/Password is invalid");
        }

        if(!password_verify($user->getPassword(), $matches->getPassword())) {
            throw new FormException("Username/Password is invalid");
        }
    }

    /**
     * @return UserRepository
     */
    private function getUserRepository() : UserRepository
    {
        /** @var UserRepository $user */
        $user = $this->entity_manager->getRepository(User::class);

        return $user;
    }
}