<?php
namespace App\User\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class UserRepository
 *
 * @package TMI\User\Entity
 */
class UserRepository extends EntityRepository
{
    /**
     * @param string $username
     *
     * @return bool
     */
    public function usernameExists(string $username) : bool
    {
        $user = $this->findOneBy(['username' => $username]);
        return !empty($user);
    }

    /**
     * @param string $email
     *
     * @return bool
     */
    public function emailExists(string $email) : bool
    {
        $email = $this->findOneBy(['email' => $email]);
        return !empty($email);
    }
}