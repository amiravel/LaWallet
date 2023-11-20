<?php

namespace Tests\Feature\Api\Client;

use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransactionTest extends TestCase
{

    use RefreshDatabase;

    public function testUserCanSeeTheirTransactionList()
    {
        $user = $this->login();

        $wallet = Wallet::factory()->create(['user_id' => $user->id]);
        $transaction = Transaction::factory()->create(['from_id' => $wallet->id]);

        $this->getJson(route('transactions.index'))
            ->assertOk()
            ->assertJsonFragment(
                (new TransactionResource($transaction))->toArray(request())
            );
    }

    public function testUserCanSeeTheirTransactionLItem()
    {
        $user = $this->login();

        $wallet = Wallet::factory()->create(['user_id' => $user->id]);
        $transaction = Transaction::factory()->create(['from_id' => $wallet->id]);

        $this->getJson(route('transactions.show', $transaction))
            ->assertOk()
            ->assertJsonFragment(
                (new TransactionResource($transaction))->toArray(request())
            );
    }
}
