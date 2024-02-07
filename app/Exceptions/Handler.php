<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Throwable;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class Handler extends ExceptionHandler
{
    public function render($request, Throwable $exception)
    {


        // **** API ****

        // Si la excepción es TokenInvalidException y la solicitud es una API
        if ($exception instanceof TokenInvalidException && $request->is('api/*')) {
            return response()->json(
                ['success' => -1,
                    'error' => 'Token no es valido'

                ], 401);
        }

        // Si la excepción es UnauthorizedHttpException y la solicitud es una API
        if ($exception instanceof UnauthorizedHttpException && $request->is('api/*')) {
            return response()->json(
                ['success' => -2,
                    'error' => 'Token no es valido'

                ], 401);
        }

        if ($exception instanceof JWTException && $request->is('api/*')) {
            return response()->json(
                ['success' => -3,
                    'error' => 'Token no es valido'

                ], 401);
        }

        return parent::render($request, $exception);
    }


    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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

            /*$this->renderable(function(TokenInvalidException $e, $request){
                return Response::json(['error'=>'Invalid token'],401);
            });
            $this->renderable(function (TokenExpiredException $e, $request) {
                return Response::json(['error'=>'Token has Expired'],401);
            });

            $this->renderable(function (JWTException $e, $request) {
                return Response::json(['error'=>'Token not parsed'],401);
            });*/


        });
    }
}
