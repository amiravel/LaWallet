<?php

namespace App\Adapters\Contracts;

use App\DataTransferObjects\OfferDto;
use App\Models\Offer;
use Illuminate\Http\Request;

interface OfferAdapterInterface
{

    public function fromRequestToOfferDto(Request $request): OfferDto;

    public function fromOfferModelToDto(Offer $offer): OfferDto;

}
