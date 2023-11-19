<?php

namespace App\Enums;

use App\Enums\Traits\InteractsWithEnums;

enum WalletStatusEnum
{

    use InteractsWithEnums;

    case active;

    case deActive;

    case block;
}
