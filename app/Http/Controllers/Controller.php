<?php

namespace App\Http\Controllers;

use App\Responses\Contracts\ResponseInterface;
use App\Services\Contracts\BaseResourceServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected ResponseInterface $response;
    protected BaseResourceServiceInterface $service;

    public function __construct(ResponseInterface $response, BaseResourceServiceInterface $service)
    {
        $this->response = $response;
        $this->service = $service;
    }
}
