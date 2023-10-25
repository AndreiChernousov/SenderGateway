<?php

namespace App\Http\Controllers\Api\V1;

use App\Enum\ResponseCodeEnums;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\AuthRequest;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    use ApiResponseTrait;

    public function auth(AuthRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $user = User::where('email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return $this->sendResponse(
                [],
                ResponseCodeEnums::CREDENTIALS_ERROR->toObject()
            );
        }

        $token = $user->createToken(
            $validated['device_name'],
            ['*'],
            new \DateTime('+1 week')
        );

        return $this->sendResponse(
            [
                'token' => $token->plainTextToken,
                'expires_at' => $token->accessToken['expires_at'],
            ],
            ResponseCodeEnums::AUTH_OK->toObject()
        );
    }

}
