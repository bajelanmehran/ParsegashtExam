<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\UserRepository;
use App\Services\User\DTOs\UserFilterData;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserRepositoryTest extends TestCase
{
    /**
     * Clean and Renew DB
     */
    use RefreshDatabase;

    /**
     * Fetch all users test
     * @return void
     */
    public function test_return_all_users(): void
    {
        User::factory()->count(5)->create();

        $repo = app(UserRepositoryInterface::class);

        $result = $repo->fetchAll(
            new UserFilterData(null, null, null, null)
        );

        $this->assertCount(5, $result);
    }

    /**
     * Filter users by country test
     * @return void
     */
    public function test_filter_users_by_country(): void
    {
        User::factory()->count(5)->create();
        User::factory()->create(['country' => 'Iran']);

        $repo = app(UserRepositoryInterface::class);

        $filters = new UserFilterData('IRAN', null, null, null);

        $result = $repo->fetchAll($filters);

        $this->assertCount(1, $result);
    }

    /**
     * Filter users by currency test
     * @return void
     */
    public function test_filter_users_by_currency(): void
    {
        User::factory()->count(5)->create();
        User::factory()->create(['currency' => 'IRR']);

        $repo = app(UserRepositoryInterface::class);

        $filters = new UserFilterData(null, 'irr', null, null);

        $result = $repo->fetchAll($filters);

        $this->assertCount(1, $result);
    }

    /**
     * Sort users by name (DESC) test
     * @return void
     */
    public function test_sort_users_by_name_desc(): void
    {
        User::factory()->create(['name' => 'Ali']);
        User::factory()->create(['name' => 'Zebra']);
        User::factory()->create(['name' => 'Reza']);
        User::factory()->create(['name' => 'Mehran']);

        $repo = app(UserRepositoryInterface::class);

        $filters = new UserFilterData(null, null, 'name', 'DESC');

        $result = $repo->fetchAll($filters);

        $this->assertEquals('Zebra', $result->first()->name);
    }
}
