<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Debug\Exception\FatalThrowableError;
use Illuminate\Auth\AuthenticationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var string[]
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {

        $this->reportable(function (Exception $e) {
            $response = [
            'success'     => false,
            'status_code' => (int)$e->getStatusCode(),
            'message'     => $e->getMessage(),
        ];
          return response()->json($response, $e->getStatusCode());
        });

    }


    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
                $error      = "User is unauthorized";
                $error_code = (int)401;
                $response   = [
                 'success'     => false,
                 'status_code' => $error_code,
                 'message'     => $error,
                ];
                return response()->json($response, $error_code);
        }
        return redirect()->guest(route($login));
    }

    protected function fatal($request, FatalThrowableError $exception)
    {
        if ($request->expectsJson()) {
                $error      = $exception->getMessage();
                $error_code = (int)401;
                $response   = [
                 'success'     => false,
                 'status_code' => $error_code,
                 'message'     => $error,
                ];
                return response()->json($response, $error_code);
        }
        return redirect()->guest(route($login));
    }
     



  

}
