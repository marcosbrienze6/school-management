<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Middleware\CorsMiddleware;

use Illuminate\Validation\ValidationException;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__.'/../routes/api.php',
        apiPrefix: 'api/',
        health: '/up',
    )
    ->withMiddleware(function ($middleware) {
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (Throwable $exception, Request $request) {
            $response = [
            'error' => true,
            'message' => $exception->getMessage(),
            ];
         
            if ($exception instanceof ValidationException) {
                $response['data'] = $exception->errors();
                $response['message'] = 'Os dados fornecidos são inválidos.';
                $statusCode = $exception->status;
            } elseif (config('app.debug')) {
                $response['file'] = $exception->getFile() ?? null;
                $response['line'] = $exception->getLine() ?? null;
                $response['trace'] = $exception->getTrace();
                $statusCode = $exception->getCode() ?: 500;
            } elseif ($exception instanceof NotFoundHttpException) {
      
                $response['message'] = 'A rota ou recurso solicitado não foi encontrado.';
                $statusCode = 404;
            } elseif ($exception instanceof HttpException) {
          
                $statusCode = $exception->getStatusCode();
            } else {
                $statusCode = $exception->getCode() ?: 500;

                if (!is_numeric($statusCode) || $statusCode < 100 || $statusCode > 599) {
                    $statusCode = 500;
                }

                if ($statusCode === 500 && app()->environment('production')) {
                    $response['message'] = 'Erro interno no servidor.';
                }
            }
            // return new JsonResponse(
            //     $response,
            //     $statusCode,
            //     $exception instanceof HttpException ? $exception->getHeaders() : [],
            //     JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
            // );
        });
    })->create();
