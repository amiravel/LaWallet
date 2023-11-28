<?php

namespace App\Shields\Appliers;

use App\Shields\Contracts\ShieldApplyInterface;
use App\Shields\Shields\AmountIsSufficientOfferShield;
use App\Shields\Shields\MyWalletOfferShield;

class OfferApplier extends BaseApplier implements ShieldApplyInterface
{
    protected array $shields = [
        MyWalletOfferShield::class,
        AmountIsSufficientOfferShield::class
    ];

}
