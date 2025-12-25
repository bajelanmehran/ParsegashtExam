<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\UsersRequest;
use App\Http\Resources\UserResource;
use App\Services\User\Contracts\UserServiceInterface;
use App\Services\User\DTOs\UserData;
use App\Services\User\DTOs\UserFilterData;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct(
        private UserServiceInterface $userService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(UsersRequest $request)
    {
        $filters = UserFilterData::fromArray($request->validated());

        return $this->toJson(
            UserResource::collection(
                $this->userService->getAllUsers($filters)
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {
        $params = UserData::fromArray($request->validated());

        return $this->toJson(
            UserResource::make(
                $this->userService->createOne($params)
            )
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return $this->toJson(
            UserResource::make(
                $this->userService->getById($id)
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(int $id, UpdateUserRequest $request)
    {
        return $this->toJson(
            UserResource::make(
                $this->userService->updateOne($id, UserData::fromArray($request->validated()))
            )
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        return $this->toJson([
            'success' => $this->userService->deleteOne($id)
        ]);
    }
}
