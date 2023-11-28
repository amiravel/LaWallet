<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->artisan('cache:clear');
    }

    public function login()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        return $user;
    }
}
