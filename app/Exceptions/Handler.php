<?php

namespace App\Exceptions;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        $response = ['error' => true, 'message' => $exception->getMessage()];

        if ($exception instanceof ValidationException) {
            $response['data'] = $exception->errors();
            $response['message'] = 'Os dados fornecidos são inválidos.';
        } elseif (env('APP_DEBUG')) {
            $response['file'] = $exception->getFile() ?? null;
            $response['line'] = $exception->getLine() ?? null;
            $response['trace'] = $exception->getTrace();
        }

        $statusCode = null;

        if ($this->isHttpException($exception) && method_exists($exception, 'getStatusCode')) {
            $statusCode = $exception->getStatusCode();
        } elseif ($exception instanceof ValidationException) {
            $statusCode = $exception->status;
        } elseif ($exception instanceof GuzzleException) {
            $statusCode = 500;
        } else {
            $statusCode = $exception->getCode() ?: 500;

            if (!is_numeric($statusCode) || $statusCode < 100 || $statusCode > 500) {
                $statusCode = 500;
            }
        }

        if ($statusCode == 500 && (env('APP_ENV') == 'production' || !env('APP_DEBUG'))) {
            $response['message']    = 'Erro interno no servidor';
            $response['exception']  = $exception->getMessage();
        }

        return new JsonResponse(
            $response,
            $statusCode,
            $this->isHttpException($exception) ? $exception->getHeaders() : [],
            JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
        );
    }
}