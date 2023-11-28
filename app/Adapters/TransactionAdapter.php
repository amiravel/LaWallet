<?php

namespace App\Adapters;

use App\Adapters\Contracts\TransactionAdapterInterface;
use App\DataTransferObjects\TransactionDTO;
use App\Enums\TransactionTypesEnum;

class TransactionAdapter implements TransactionAdapterInterface
{

    public function fromOfferModelToTransaction(\App\Models\Offer $offer): TransactionDTO
    {
        return new TransactionDTO(
            $offer->wallet_id,
            $offer->wallet_id,
            $offer->budget_amount,
            TransactionTypesEnum::createOffer->name
        );
    }
}
