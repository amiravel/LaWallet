<?php

namespace App\Repositories\Contracts;

use App\Models\Offer;
use Illuminate\Database\Eloquent\Model;

interface OfferRepositoryInterface extends BaseRepositoryInterface
{

    public function offerScannedByUser(int $offerId, int $userId): bool;

    public function findByCode(string $code): Model;

    public function scan(Offer $offer, int $userId): void;

}
