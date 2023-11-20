<?php

namespace App\Services;

use App\Repositories\Contracts\BaseRepositoryInterface;
use App\Repositories\Contracts\OfferRepositoryInterface;
use App\Services\Contracts\CacheServiceInterface;
use App\Services\Contracts\OfferServiceInterface;

class OfferService extends BaseResourceService implements OfferServiceInterface
{

    public function __construct(OfferRepositoryInterface $repository, CacheServiceInterface $cacheService)
    {
        parent::__construct($repository, $cacheService);
    }

}
