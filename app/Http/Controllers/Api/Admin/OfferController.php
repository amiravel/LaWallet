<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\OfferStoreRequest;
use App\Http\Resources\Admin\OfferResource;
use App\Responses\Contracts\ResponseInterface;
use App\Services\Contracts\OfferServiceInterface;
use App\Shields\Appliers\OfferApplier;
use Illuminate\Support\Facades\App;

class OfferController extends Controller
{

    public function __construct(ResponseInterface $response, OfferServiceInterface $service)
    {
        parent::__construct($response, $service);
    }

    public function index()
    {
        return $this->response->list(
            OfferResource::collection(
                $this->service->paginate(request('page', 1))
            )
        );
    }

    public function store(OfferStoreRequest $request)
    {
        App::make(OfferApplier::class)->apply($request);

        return $this->response->item(
            new OfferResource(
                $this->service->create($request->validated())
            )
        );
    }

    public function show(int $id)
    {
        return $this->response->item(
            new OfferResource(
                $this->service->find($id)
            )
        );
    }

    public function destroy(int $id)
    {

    }

}
