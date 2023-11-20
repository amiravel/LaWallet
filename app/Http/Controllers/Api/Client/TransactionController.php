<?php

namespace app\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use App\Responses\Contracts\ResponseInterface;
use App\Services\Contracts\TransactionServiceInterface;

class TransactionController extends Controller
{

    public function __construct(ResponseInterface $response, TransactionServiceInterface $service)
    {
        parent::__construct($response, $service);
    }

    public function index()
    {
        return $this->response->list(
            TransactionResource::collection(
                $this->service->forUser(auth()->id())
                    ->paginate(request('page', 1))
            )
        );
    }

    public function show(int $id)
    {
        return $this->response->item(
            new TransactionResource(
                $this->service->forUser(auth()->id())->find($id)
            )
        );
    }

}
