<?php

namespace Database\Factories;

use App\Enums\TransactionTypesEnum;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'from_id' => Wallet::factory()->create(),
            'to_id' => Wallet::factory()->create(),
            'amount' => random_int(1, 5000000),
            'hash' => Str::random(),
            'type' => TransactionTypesEnum::withdraw->name
        ];
    }
}
