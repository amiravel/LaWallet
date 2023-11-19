<?php

namespace App\Models;

use App\Enums\WalletStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'status' => WalletStatusEnum::class
    ];
}
