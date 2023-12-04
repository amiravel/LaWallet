<?php

namespace App\Shields\Shields;

use App\DataTransferObjects\OfferDto;
use App\Services\Contracts\OfferScanServiceInterface;
use App\Shields\Contracts\OfferShieldInterface;

class UserNotScannedOfferBefore implements OfferShieldInterface
{

    private OfferScanServiceInterface $service;

    public function __construct(OfferScanServiceInterface $service)
    {
        $this->service = $service;
    }

    public function handle(OfferDto $offerDto): void
    {
        if ($this->service->offerScannedByUser($offerDto->id, auth()->id())){
            abort(403, 'you can not scan it again!');
        }
    }

}
