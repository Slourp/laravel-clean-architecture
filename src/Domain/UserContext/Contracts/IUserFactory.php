<?php

namespace Domain\UserContext\Contracts;

use Domain\UserContext\Entity\User;

interface IUserFactory
{
    /**
     * @param array<mixed> $attributes
     */
    public function make(array $attributes = []): User;
}
