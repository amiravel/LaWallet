<?php

namespace App\Enums\Traits;
trait InteractsWithEnums
{

    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

}
