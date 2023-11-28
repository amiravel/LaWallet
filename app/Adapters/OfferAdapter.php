<?php

namespace App\Adapters;

use App\Adapters\Contracts\OfferAdapterInterface;
use App\DataTransferObjects\OfferDto;
use App\Models\Offer;
use Illuminate\Http\Request;

class OfferAdapter implements OfferAdapterInterface
{

    public function fromRequestToOfferDto(Request $request): OfferDto
    {
        return new OfferDto(
            $request->get('wallet_id'),
            $request->get('code'),
            $request->get('budget_amount'),
            $request->get('amount_per_scan'),
            $request->get('max_scan'),
            $request->get('starts_at'),
            $request->get('ends_at')
        );
    }

    public function fromOfferModelToDto(Offer $offer): OfferDto
    {
        return new OfferDto(
            $offer->wallet_id,
            $offer->code,
            $offer->budget_amount,
            $offer->amount_per_scan,
            $offer->max_scan,
            $offer->starts_at,
            $offer->ends_at,
            $offer->users()->count()
        );
    }
}
