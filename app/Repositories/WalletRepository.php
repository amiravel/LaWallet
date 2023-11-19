<?php

namespace App\Repositories;

use App\Models\Wallet;
use App\Repositories\Contracts\WalletRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class WalletRepository extends BaseRepository implements WalletRepositoryInterface
{
    public function __construct(Wallet $model)
    {
        parent::__construct($model);
    }

}
