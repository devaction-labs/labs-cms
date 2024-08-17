<?php

namespace App\Utilities\JsonResponse;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait ResponseJson
{
    public function jsonResponse(array $data, int $status = Response::HTTP_OK): JsonResponse
    {
        if (empty($data)) {
            $status = Response::HTTP_NOT_FOUND;
        }

        if (isset($data['error'])) {
            $status = Response::HTTP_BAD_REQUEST;
        }

        return response()->json([
            'data' => $data,
        ], $status);
    }
}
