<?php

namespace App\Services\User\Contracts;

use App\Services\User\DTOs\UserData;
use App\Services\User\DTOs\UserFilterData;

interface UserServiceInterface
{
    public function getAllUsers(UserFilterData $filters);
    public function getByName(string $name);
    public function getById(int $id);
    public function createOne(UserData $data);
    public function updateOne(int $id, UserData $data);
    public function deleteOne(int $id);

}
