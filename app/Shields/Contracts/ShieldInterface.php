<?php

namespace App\Shields\Contracts;

interface ShieldInterface
{

    public function handle(\Illuminate\Http\Request $request);

}
