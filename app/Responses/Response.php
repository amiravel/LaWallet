<?php

namespace App\Responses;

use App\Responses\Contracts\ResponseInterface;
use Illuminate\Http\Response as JsonResponse;
use Illuminate\Support\Facades\Storage;
use \Symfony\Component\HttpFoundation\Response as HttpResponseCode;

class Response implements ResponseInterface
{

    /**
     * @OA\Schema(
     *     schema="Success",
     *     @OA\Property(property="code",  type="string", example="200"),
     *     @OA\Property(property="message",  type="string", example="OK"),
     * ),
     */
    public function success($message = 'Ok')
    {
        return response([
            'code' => HttpResponseCode::HTTP_OK,
            'message' => $message
        ], HttpResponseCode::HTTP_OK);
    }

    public function error($message, $status): JsonResponse
    {
        return response([
            'code' => $status,
            'message' => $message
        ], $status);
    }

    public function list($data)
    {
        return response([
            'code' => HttpResponseCode::HTTP_OK,
            'data' => method_exists($data, 'items') ? $data->items() : $data,
            'meta' => [
                'current_page' => method_exists($data, 'currentPage') ? $data->currentPage() : null,
                'next_page' => method_exists($data, 'nextPageUrl') ? $data->nextPageUrl() : null,
                'last_page' => method_exists($data, 'lastPage') ? $data->lastPage() : null,
                'path' => method_exists($data, 'path') ? $data->path() : null,
                'total' => method_exists($data, 'total') ? $data->total() : null,
                'per_page' => method_exists($data, 'perPage') ? $data->perPage() : null,
            ]
        ], HttpResponseCode::HTTP_OK);
    }

    public function item($data): JsonResponse
    {
        return response([
            'code' => HttpResponseCode::HTTP_OK,
            'data' => $data
        ], HttpResponseCode::HTTP_OK);
    }

    public function loadFile(string $path)
    {
        return Storage::download($path);
    }
}
