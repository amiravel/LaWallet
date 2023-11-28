<?php

namespace App\Shields\Shields;

use App\DataTransferObjects\OfferDto;
use App\Shields\Contracts\OfferShieldInterface;

class MaxScanLimitReached implements OfferShieldInterface
{

    public function handle(OfferDto $offerDto): void
    {
        $maxScanLimitReached = $offerDto->max_scan == $offerDto->scan_count;

        if ($maxScanLimitReached){
            abort(403, 'scan limit reached');
        }

    }

}
