<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\User\DTOs\UserData;
use App\Services\User\DTOs\UserFilterData;
use Illuminate\Support\Collection;

class UserRepository implements UserRepositoryInterface
{

    /**
     * Find a user from Database by `id` field.
     * @param int $id
     * @return User|null
     */
    public function findById(int $id): ?User
    {
        return User::find($id);
    }

    /**
     * Find a user from Database by `name` field.
     * @param string $name
     * @return User|null
     */
    public function findByName(string $name): ?User
    {
        return User::where('name', $name)->first();
    }

    /**
     * Find a user from Database by `email` field.
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    /**
     * Fetch the users from Database by the `country` field.
     * @param string $country
     * @return Collection
     */
    public function findByCountry(string $country): Collection
    {
        return User::where('country', $country)->get();
    }

    /**
     * Fetch the users from Database by the `currency` field.
     * @param string $currency
     * @return Collection
     */
    public function findByCurrency(string $currency): Collection
    {
        return User::where('currency', $currency)->get();
    }

    /**
     * Fetch all the users from the database.
     * @return Collection
     */
    public function fetchAll(UserFilterData $filters): Collection
    {
        return User::query()
            ->when($filters->country, fn ($query) =>
                $query->whereRaw('LOWER(country) LIKE ?', [$filters->country])
            )
            ->when($filters->currency, fn ($query) =>
                $query->whereRaw('LOWER(currency) LIKE ?', [$filters->currency])
            )
            ->when($filters->orderBy, fn ($query) =>
                $query->orderBy(
                    $filters->orderBy,
                    $filters->orderDirection ?? 'ASC'
                )
            )
            ->get();
    }

    /**
     * Create a new user.
     * @param UserData $data
     * @return User
     */
    public function create(UserData $data): User
    {
        return User::create((array) $data);
    }

    /**
     * Update a user that was created before.
     * @param User $user
     * @param array $data
     * @return User
     */
    public function update(User $user, UserData $data): User
    {
        $user->update((array) $data);

        return $user;
    }

    public function delete(User $user): bool
    {
        return $user->deleteOrFail();
    }
}
