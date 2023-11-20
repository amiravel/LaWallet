<?php

namespace App\Responses\Contracts;

use Illuminate\Http\Response as JsonResponse;
interface ResponseInterface
{

    public function success($message = 'Ok');

    public function error($message, $status): JsonResponse;

    public function list($data);

    public function item($data);

    public function loadFile(string $path);

}
