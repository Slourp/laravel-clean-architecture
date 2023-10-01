<?php
namespace Domain\UserContext\Factory;

use Domain\UserContext\Contracts\UserFactory as ContractsUserFactory;
use Domain\UserContext\Entity\User;

class  UserFactory implements ContractsUserFactory
{
    /**
     * @param array<mixed> $attributes
     */
    public function make(array $attributes = []):User{
        return new User;
    }
}