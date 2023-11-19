<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $casts = [
        'starts_at' => 'date',
        'ends_at' => 'date',
    ];

    protected $guarded = [];
}
