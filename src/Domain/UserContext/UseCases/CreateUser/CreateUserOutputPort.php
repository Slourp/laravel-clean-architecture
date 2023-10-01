<?php

namespace Domain\UserContext\UseCases\CreateUser;

use App\Domain\UseCases\CreateUser\CreateUserResponseModel;
use Domain\UserContext\contracts\ViewModel;


interface CreateUserOutputPort
{
    public function userCreated(CreateUserResponseModel $model): ViewModel;

    public function userAlreadyExists(CreateUserResponseModel $model): ViewModel;

    public function unableToCreateUser(CreateUserResponseModel $model, \Throwable $e): ViewModel;
}
