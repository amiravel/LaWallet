<?php

namespace App\Shields\Appliers;

use App\DataTransferObjects\Dto;
use Illuminate\Support\Facades\App;

abstract class BaseApplier
{

    protected array $shields = [];

    public function apply(Dto $dto)
    {
        foreach ($this->shields as $shield) {
            App::make($shield)->handle($dto);
        }
    }

}
