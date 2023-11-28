<?php

namespace App\Adapters;

use App\Adapters\Contracts\TransactionAdapterInterface;
use App\DataTransferObjects\TransactionDto;
use App\Enums\TransactionTypesEnum;
use App\Models\Offer;
use App\Models\Wallet;

class TransactionAdapter implements TransactionAdapterInterface
{

    public function fromOfferModelToTransaction(\App\Models\Offer $offer): TransactionDto
    {
        return new TransactionDto(
            $offer->wallet_id,
            $offer->wallet_id,
            $offer->budget_amount,
            TransactionTypesEnum::createOffer->name
        );
    }

    public function scanOfferDataToTransaction(Offer $offer, Wallet $wallet): TransactionDto
    {
        return new TransactionDto(
            $offer->wallet_id,
            $wallet->id,
            $offer->amount_per_scan,
            TransactionTypesEnum::scanOffer->name
        );
    }
}
