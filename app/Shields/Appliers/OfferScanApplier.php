<?php

namespace App\Shields\Appliers;

use App\Shields\Contracts\ShieldApplyInterface;
use App\Shields\Shields\MaxScanLimitReached;
use App\Shields\Shields\OfferScanDoesNotGoFurtherThanBudgetOfferShield;
use App\Shields\Shields\UserNotScannedOfferBefore;

class OfferScanApplier extends BaseApplier implements ShieldApplyInterface
{

    protected array $shields = [
        UserNotScannedOfferBefore::class,
        MaxScanLimitReached::class,
        OfferScanDoesNotGoFurtherThanBudgetOfferShield::class,
    ];

}
