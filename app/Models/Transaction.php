<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function from()
    {
        return $this->belongsTo(Wallet::class);
    }

    public function to()
    {
        return $this->belongsTo(Wallet::class);
    }
}
