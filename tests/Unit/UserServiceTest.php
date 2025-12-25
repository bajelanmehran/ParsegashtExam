<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Exceptions\ApiException;
use App\Services\User\Contracts\UserServiceInterface;
use App\Services\User\DTOs\UserFilterData;

class UserServiceTest extends TestCase
{
    /**
     * Clean and Renew DB
     */
    use RefreshDatabase;


    /**
     * Test the user service throw exceptions
     * @return void
     */
    public function test_service_empty_list(): void
    {
        $this->expectException(ApiException::class);

        $service = app(UserServiceInterface::class);

        $service->getAllUsers(
            new UserFilterData(null, null, null, null)
        );
    }
}
