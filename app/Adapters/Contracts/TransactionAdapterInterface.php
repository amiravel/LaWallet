<?php

namespace App\Adapters\Contracts;


use App\DataTransferObjects\TransactionDTO;

interface TransactionAdapterInterface
{

    public function fromOfferModelToTransaction(\App\Models\Offer $offer): TransactionDTO;

}
