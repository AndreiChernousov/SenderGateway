<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponseTrait
{

    public function sendResponse(
        $data,
        $responseCodeObject
    ): JsonResponse {
        $statusCode = $responseCodeObject->status;
        $responseCode = $responseCodeObject->response_code;
        $responseCodeMessage = $responseCodeObject->message;

        return response()->json([
            'status' => $statusCode,
            'response_code' => $responseCode,
            'message' => $responseCodeMessage,
            'data' => $data,
        ], $statusCode);
    }

}
