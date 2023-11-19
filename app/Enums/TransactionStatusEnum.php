<?php

namespace App\Enums;

use App\Enums\Traits\InteractsWithEnums;

enum TransactionStatusEnum
{
    use InteractsWithEnums;

    case pending;

    case failed;

    case done;
}
