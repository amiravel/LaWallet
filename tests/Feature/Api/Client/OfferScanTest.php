<?php

namespace Tests\Feature\Api\Client;

use App\Models\Offer;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OfferScanTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCanScanOffer()
    {
        $budgetWallet = Wallet::factory()->create([
            'amount' => 100000,
            'blocked_amount' => 100000
        ]);
        $offer = Offer::factory()->create([
            'wallet_id' => $budgetWallet->id,
            'amount_per_scan' => 1000,
            'budget_amount' => $budgetWallet->blocked_amount
        ]);
        $user = $this->login();
        $wallet = Wallet::factory()->create(['user_id' => $user->id, 'amount' => 0]);

        $this->postJson(route('offer.store'), ['code' => $offer->code])
            ->assertOk();

        $this->assertDatabaseHas('wallets', [
            'id' => $wallet->id,
            'amount' => $offer->amount_per_scan
        ]);

        $this->assertDatabaseMissing('wallets', [
            'id' => $wallet->id,
            'amount' => 0
        ]);

        $this->assertDatabaseHas('wallets', [
            'id' => $budgetWallet->id,
            'blocked_amount' => $budgetWallet->blocked_amount - $offer->amount_per_scan
        ]);

        $this->assertDatabaseHas('offer_user', [
            'offer_id' => $offer->id,
            'user_id' => $user->id
        ]);

        $this->assertDatabaseHas('transactions', [
            'from_id' => $budgetWallet->id,
            'to_id' => $wallet->id,
            'amount' => $offer->amount_per_scan
        ]);

    }

    public function testIfMaxScanLimitReachedNoBodyCanScanIt()
    {
        $budgetWallet = Wallet::factory()->create([
            'amount' => 100000,
            'blocked_amount' => 100000
        ]);
        $offer = Offer::factory()->create([
            'wallet_id' => $budgetWallet->id,
            'max_scan' => 1,
            'amount_per_scan' => 1000,
            'budget_amount' => $budgetWallet->blocked_amount
        ]);
        $offer->users()->attach(User::factory()->create());

        $user = $this->login();
        $wallet = Wallet::factory()->create(['user_id' => $user->id, 'amount' => 0]);

        $this->postJson(route('offer.store'), ['code' => $offer->code])
            ->assertStatus(403);

        $this->assertDatabaseMissing('wallets', [
            'id' => $wallet->id,
            'amount' => $offer->amount_per_scan
        ]);

        $this->assertDatabaseHas('wallets', [
            'id' => $wallet->id,
            'amount' => 0
        ]);

        $this->assertDatabaseMissing('wallets', [
            'id' => $budgetWallet->id,
            'blocked_amount' => $budgetWallet->blocked_amount - $offer->amount_per_scan
        ]);

        $this->assertDatabaseMissing('offer_user', [
            'offer_id' => $offer->id,
            'user_id' => $user->id
        ]);

        $this->assertDatabaseMissing('transactions', [
            'from_id' => $budgetWallet->id,
            'to_id' => $wallet->id,
            'amount' => $offer->amount_per_scan
        ]);
    }

    public function testUserCanScanOfferOnce()
    {
        $budgetWallet = Wallet::factory()->create([
            'amount' => 100000,
            'blocked_amount' => 100000
        ]);
        $offer = Offer::factory()->create([
            'wallet_id' => $budgetWallet->id,
            'max_scan' => 1,
            'amount_per_scan' => 1000,
            'budget_amount' => $budgetWallet->blocked_amount
        ]);

        $user = $this->login();

        $offer->users()->attach($user);

        $wallet = Wallet::factory()->create(['user_id' => $user->id, 'amount' => 0]);

        $this->postJson(route('offer.store'), ['code' => $offer->code])
            ->assertStatus(403);

        $this->assertDatabaseMissing('wallets', [
            'id' => $wallet->id,
            'amount' => $offer->amount_per_scan
        ]);

        $this->assertDatabaseHas('wallets', [
            'id' => $wallet->id,
            'amount' => 0
        ]);

        $this->assertDatabaseMissing('wallets', [
            'id' => $budgetWallet->id,
            'blocked_amount' => $budgetWallet->blocked_amount - $offer->amount_per_scan
        ]);

        $this->assertDatabaseHas('offer_user', [
            'offer_id' => $offer->id,
            'user_id' => $user->id
        ]);

        $this->assertDatabaseMissing('transactions', [
            'from_id' => $budgetWallet->id,
            'to_id' => $wallet->id,
            'amount' => $offer->amount_per_scan
        ]);
    }

    public function testIfBudgetLimitReachedNoBodyCanScanIt()
    {
        $budgetWallet = Wallet::factory()->create([
            'amount' => 100000,
            'blocked_amount' => 0
        ]);
        $offer = Offer::factory()->create([
            'wallet_id' => $budgetWallet->id,
            'max_scan' => 1,
            'amount_per_scan' => 1000,
            'budget_amount' => $budgetWallet->blocked_amount
        ]);

        $user = $this->login();

        $wallet = Wallet::factory()->create(['user_id' => $user->id, 'amount' => 0]);

        $this->postJson(route('offer.store'), ['code' => $offer->code])
            ->assertStatus(403);

        $this->assertDatabaseMissing('wallets', [
            'id' => $wallet->id,
            'amount' => $offer->amount_per_scan
        ]);

        $this->assertDatabaseHas('wallets', [
            'id' => $wallet->id,
            'amount' => 0
        ]);

        $this->assertDatabaseMissing('wallets', [
            'id' => $budgetWallet->id,
            'blocked_amount' => $budgetWallet->blocked_amount - $offer->amount_per_scan
        ]);

        $this->assertDatabaseMissing('offer_user', [
            'offer_id' => $offer->id,
            'user_id' => $user->id
        ]);

        $this->assertDatabaseMissing('transactions', [
            'from_id' => $budgetWallet->id,
            'to_id' => $wallet->id,
            'amount' => $offer->amount_per_scan
        ]);
    }
}
