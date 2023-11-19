<?php

namespace App\Shields\Shields;

use App\Shields\Contracts\ShieldInterface;

class OfferScanDoesNotGoFurtherThanBudgetShield implements ShieldInterface
{
    public function handle(\Illuminate\Http\Request $request)
    {
//        $amount = $request->get('amount');
//        $amountPerScan = $request->get('amount_per_scan');
//        $maxScan = $request->get('max_scan');


    }
}
