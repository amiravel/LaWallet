<?php

namespace App\Shields\Appliers;

use Illuminate\Support\Facades\App;

abstract class BaseApplier
{

    protected array $shields = [];
    public function apply(\Illuminate\Http\Request $request)
    {
        foreach ($this->shields as $shield){
            return App::make($shield)->handle($request);
        }
    }

}
