<?

namespace Domain\UserContext\Repository;

use Domain\UserContext\Entity\User;
use Domain\UserContext\ValueObject\PasswordValueObject;

interface IUserCommandRepository
{
    public function create(User $user, PasswordValueObject $password): User;
    public function save(User $user): void;
    public function update(User $user): void;
    public function delete(int $id): void;
}
