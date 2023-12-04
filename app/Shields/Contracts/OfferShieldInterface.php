<?php

namespace App\Shields\Contracts;

use App\DataTransferObjects\Dto;
use App\DataTransferObjects\OfferDto;

interface OfferShieldInterface
{

    public function handle(OfferDto $offerDto);

}
