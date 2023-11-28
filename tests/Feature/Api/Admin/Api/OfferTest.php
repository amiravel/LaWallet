<?php

namespace Tests\Feature\Api\Admin\Api;

use App\Http\Resources\Admin\OfferResource;
use App\Models\Offer;
use App\Models\Wallet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OfferTest extends TestCase
{
    use RefreshDatabase;

    public function testAdminCanSeeListOfOffers()
    {
        $this->login();

        $offer = Offer::factory()->create();

        $this->getJson(route('admin.offers.index'))
            ->assertOk()
            ->assertJsonFragment(
                (new OfferResource($offer))->toArray(request())
            );
    }


    public function testAdminCanCreateNewOffer()
    {
        $user = $this->login();

        $wallet = Wallet::factory()->create([
            'user_id' => $user->id,
            'amount' => 1000000000
        ]);

        $offer = Offer::factory()->make([
            'wallet_id' => $wallet->id
        ]);
        $data = $offer->toArray();

        unset($data['created_at'], $data['updated_at']);

        $this->postJson(route('admin.offers.store'), $data)
            ->assertOk()
            ->assertJsonFragment(
                (new OfferResource($offer))->toArray(request())
            );

        $this->assertDatabaseHas('offers', $data);

        $this->assertDatabaseHas('wallets', [
            'id' => $wallet->id,
            'amount' => $wallet->amount - $offer->budget_amount,
            'blocked_amount' => $offer->budget_amount
        ]);

        $this->assertDatabaseHas('transactions', [
            'from_id' => $wallet->id,
            'to_id' => $wallet->id,
            'amount' => $offer['budget_amount']
        ]);

    }

    public function testAdminCanSeeOfferItem()
    {
        $user = $this->login();

        $wallet = Wallet::factory()->create([
            'user_id' => $user->id,
            'amount' => 1000000000
        ]);

        $offer = Offer::factory()->create([
            'wallet_id' => $wallet->id
        ]);

        $this->getJson(route('admin.offers.show', $offer))
            ->assertOk()
            ->assertJsonFragment(
                (new OfferResource($offer))->toArray(request())
            );
    }

}
