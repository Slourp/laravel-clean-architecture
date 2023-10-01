<?php

namespace Domain\UserContext\UseCases\CreateUser;

use App\Domain\UseCases\CreateUser\CreateUserResponseModel;
use App\Domain\UserContext\Contract\IUserQueryRepository;
use Domain\UserContext\Contracts\IUserFactory;
use Domain\UserContext\contracts\ViewModel;
use Domain\UserContext\Repository\IUserCommandRepository;
use Domain\UserContext\ValueObject\PasswordValueObject;

class CreateUserInteractor implements CreateUserInputPort
{
    public function __construct(
        private CreateUserOutputPort $output,
        private IUserCommandRepository $userCommandRepository,
        private IUserQueryRepository $userQueryRepository,
        private IUserFactory $factory,
    ) {
    }

    public function createUser(CreateUserRequestCommand $command): ViewModel
    {
        $user = $this->factory->make([
            'name' => $command->getName(),
            'email' => $command->getEmail(),
        ]);

        if ($this->userQueryRepository->exists($user))
            return $this->output->userAlreadyExists(new CreateUserResponseModel($user));


        try {
            $user = $this->userCommandRepository->create($user, new PasswordValueObject($command->getPassword()));
        } catch (\Exception $e) {
            return $this->output->unableToCreateUser(new CreateUserResponseModel($user), $e);
        }

        return $this->output->userCreated(
            new CreateUserResponseModel($user)
        );
    }
}
