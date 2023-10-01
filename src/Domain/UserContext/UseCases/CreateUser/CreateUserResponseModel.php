<?php

namespace App\Domain\UseCases\CreateUser;

use Domain\UserContext\Contracts\RepsonseModel;
use Domain\UserContext\Entity\User;

class CreateUserResponseModel implements RepsonseModel
{
    public function __construct(
        private User $user
    ) {
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
