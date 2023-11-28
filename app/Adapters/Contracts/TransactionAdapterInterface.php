<?php

namespace App\Adapters\Contracts;


use App\DataTransferObjects\TransactionDto;
use App\Models\Offer;
use App\Models\Wallet;

interface TransactionAdapterInterface
{

    public function fromOfferModelToTransaction(\App\Models\Offer $offer): TransactionDto;

    public function scanOfferDataToTransaction(Offer $offer, Wallet $wallet): TransactionDto;

}
