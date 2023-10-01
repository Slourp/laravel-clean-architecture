<?
namespace App\Domain\UserContext\Contract;

use Domain\UserContext\Entity\User;

interface IUserQueryRepository {
    public function findById(int $id): ?User;
    public function findByUsername(string $username): ?User;
    public function findAll(): array;
    public function exists(User $user): bool;
}
