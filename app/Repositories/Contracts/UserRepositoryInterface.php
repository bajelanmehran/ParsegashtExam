<?php

namespace App\Repositories\Contracts;

use App\Models\User;
use App\Services\User\DTOs\UserData;
use App\Services\User\DTOs\UserFilterData;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    public function findById(int $id): ?User;
    public function findByName(string $name): ?User;
    public function findByEmail(string $email): ?User;
    public function findByCountry(string $country): Collection;
    public function findByCurrency(string $currency): Collection;

    public function fetchAll(UserFilterData $filters): Collection;

    public function create(UserData $data): User;
    public function update(User $user, UserData $data): User;
    public function delete(User $user): bool;
}
