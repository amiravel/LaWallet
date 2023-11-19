<?php

namespace App\Enums;

use App\Enums\Traits\InteractsWithEnums;

enum TransactionTypesEnum
{

    use InteractsWithEnums;

    case deposit;

    case withdraw;

    case createOffer;

    case scanOffer;

}
