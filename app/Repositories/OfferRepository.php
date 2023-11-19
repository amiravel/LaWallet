<?php

namespace App\Repositories;

use App\Models\Offer;
use App\Repositories\Contracts\OfferRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class OfferRepository extends BaseRepository implements OfferRepositoryInterface
{

    public function __construct(Offer $model)
    {
        parent::__construct($model);
    }

}
