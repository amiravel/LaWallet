<?php

namespace App\Http\Controllers\Api\Client;

use App\Adapters\Contracts\OfferAdapterInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Client\OfferScanRequest;
use App\Responses\Contracts\ResponseInterface;
use App\Services\Contracts\BaseResourceServiceInterface;
use App\Services\Contracts\OfferScanServiceInterface;
use App\Shields\Appliers\OfferScanApplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class OfferScanController extends Controller
{

    private OfferAdapterInterface $offerAdapter;

    public function __construct(
        ResponseInterface $response,
        OfferScanServiceInterface $service,
        OfferAdapterInterface $offerAdapter
    )
    {
        parent::__construct($response, $service);
        $this->offerAdapter = $offerAdapter;
    }

    public function store(OfferScanRequest $request)
    {
        $offer = $this->service->findByCode($request->get('code'));

        App::make(OfferScanApplier::class)
            ->apply(
                $this->offerAdapter->fromOfferModelToDto($offer)
            );

        $this->service->scanByUser($offer->id, auth()->id());

        return $this->response->success();
    }

}
