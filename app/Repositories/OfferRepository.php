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

    public function offerScannedByUser(int $offerId, int $userId): bool
    {
        return $this->query->where('id', $offerId)
            ->whereHas('users', function ($query) use ($userId){
                $query->where('user_id', $userId);
            })->exists();
    }

    public function findByCode(string $code): Model
    {
        return $this->query->where('code', $code)->first();
    }

    public function scan(Offer $offer, int $userId): void
    {
        $offer->users()->lockForUpdate()->attach($userId);
    }
}
