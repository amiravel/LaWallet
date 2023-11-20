<?php

namespace App\Shields\Appliers;

use App\Shields\Contracts\ShieldApplyInterface;
use App\Shields\Shields\AmountIsSufficientShield;
use App\Shields\Shields\MyWalletShield;

class OfferApplier extends BaseApplier implements ShieldApplyInterface
{
    protected array $shields = [
        MyWalletShield::class,
        AmountIsSufficientShield::class
    ];

}
