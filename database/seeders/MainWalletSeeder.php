<?php

namespace Database\Seeders;

use App\Enums\WalletStatusEnum;
use App\Models\Wallet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MainWalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Wallet::query()->create([
            'user_id' => 1,
            'amount' => 9 * 10^9,
            'blocked_amount' => 0,
            'status' => WalletStatusEnum::active
        ]);
    }
}
