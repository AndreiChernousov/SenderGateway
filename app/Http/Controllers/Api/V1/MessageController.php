<?php

namespace App\Http\Controllers\Api\V1;

use App\Enum\ResponseCodeEnums;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Message\MessageSendRequest;
use App\Jobs\SendNotification;
use App\Models\Recipient;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class MessageController extends Controller
{

    use ApiResponseTrait;

    public function send(MessageSendRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $recipient = Recipient::whereCode($validated['recipient'])->first();

        if (!$recipient) {
            return $this->sendResponse([],
                ResponseCodeEnums::NO_RECIPIENT_ERROR->toObject());
        }

        SendNotification::dispatch($recipient, $validated['message']);

        return $this->sendResponse([],
            ResponseCodeEnums::ADDED_TO_QUEUE->toObject());
    }

}
