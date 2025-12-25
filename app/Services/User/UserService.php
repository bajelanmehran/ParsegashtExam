<?php

namespace App\Services\User;

use App\Exceptions\ApiException;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\Countries\CountryService;
use App\Services\User\Contracts\UserServiceInterface;
use App\Services\User\DTOs\UserData;
use App\Services\User\DTOs\UserFilterData;

class UserService implements UserServiceInterface
{

    public function __construct(
        private UserRepositoryInterface $users,
        private CountryService $countryService
    ) {}


    public function getAllUsers(UserFilterData $filters)
    {
        $result = $this->users->fetchAll($filters);

        if(sizeof($result) === 0) throw new ApiException('List is empty');

        return $result;
    }

    public function getByName(string $name)
    {
        $result = $this->users->findByName($name);

        if(!$result) throw new ApiException('User does not exist');

        return $result;
    }

    public function getById(int $id)
    {
        $result = $this->users->findById($id);

        if(!$result) throw new ApiException('User does not exist');

        return $result;
    }

    public function createOne(UserData $data)
    {
        if($data->country) {
            $country = array_first($this->countryService->getByName($data->country));

            $data->country = $country->shortName;
            $data->currency = strtoupper($country->currency);
        }

        /*
         * can fetch random country if the request data of country was empty
         */

//        if(!$data->country || is_null($data->country)) {
//            $country = $this->countryService->getRandom();
//
//            $data->country = $country->shortName;
//            $data->currency = $country->currency;
//        }

        $data->email = strtolower($data->email);

        return $this->users->create($data);
    }

    public function updateOne(int $id, UserData $data)
    {
        $user = $this->users->findById($id);

        if(!$user) throw new ApiException('User does not exist');

        if(!is_null($data->country) && $data->country !== $user->country){
            $country = array_first($this->countryService->getByName($data->country));
            $data->currency = strtoupper($country->currency);
        }

        foreach ($data as $field => $value) {
            if(!$value) unset($data->{$field});
        }

        return $this->users->update($user, $data);
    }

    public function deleteOne(int $id)
    {
        $user = $this->users->findById($id);

        if(!$user) throw new ApiException('User does not exist');

        return $this->users->delete($user);
    }
}
