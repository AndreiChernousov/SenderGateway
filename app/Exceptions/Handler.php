<?php

namespace App\Exceptions;

use App\Enum\ResponseCodeEnums;
use App\Traits\ApiResponseTrait;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{

    use ApiResponseTrait;

    /**
     * The list of the inputs that are never flashed to the session on
     * validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(
            function (AuthenticationException $e, Request $request) {
                if ($request->is('api/*')) {
                    return $this->sendResponse([],
                        ResponseCodeEnums::TOKEN_ERROR->toObject());
                }
            }
        );

        $this->renderable(
            function (NotFoundHttpException $e, Request $request) {
                if ($request->is('api/*')) {
                    return $this->sendResponse([],
                        ResponseCodeEnums::URL_NOT_FOUND->toObject());
                }
            }
        );

        $this->renderable(
            function (ValidationException $e, Request $request) {
                if ($request->is('api/*')) {
                    return $this->sendResponse(['error' => $e->getMessage()],
                        ResponseCodeEnums::VALIDATION_ERROR->toObject());
                }
            }
        );
    }

}
