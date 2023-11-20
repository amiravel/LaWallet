<?php

namespace Database\Factories;

use App\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Offer>
 */
class OfferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'wallet_id' => Wallet::factory()->create(),
            'code' => Str::random(10),
            'amount_per_scan' => 1000000,
            'budget_amount' => 1000 * 1000000,
            'max_scan' => 1000,
            'starts_at' => now()->subHour(),
            'ends_at' => now()->addHour()
        ];
    }
}
