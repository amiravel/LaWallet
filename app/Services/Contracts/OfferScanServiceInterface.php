<?php

namespace App\Services\Contracts;

interface OfferScanServiceInterface extends \App\Services\Contracts\BaseResourceServiceInterface
{

    public function findByCode(string $code);
    public function offerScannedByUser(int $offerId, int $userId): bool;

    public function scanByUser(int $offerId, int $userId);

}
