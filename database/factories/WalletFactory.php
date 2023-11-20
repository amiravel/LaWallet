<?php

namespace Database\Factories;

use App\Enums\WalletStatusEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Wallet>
 */
class WalletFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->create(),
            'amount' => 0,
            'blocked_amount' => 0,
            'status' => WalletStatusEnum::active->name
        ];
    }
}
