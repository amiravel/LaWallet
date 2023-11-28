<?php

namespace App\DataTransferObjects;

abstract class Dto
{

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
