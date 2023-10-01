<?php

namespace Domain\UserContext\UseCases\CreateUser;

use Domain\UserContext\contracts\ViewModel;


interface CreateUserInputPort
{
    public function createUser(CreateUserRequestCommand $command): ViewModel;
}
