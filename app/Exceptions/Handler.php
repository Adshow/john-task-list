<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    public function render($request, Throwable $throwable)
    {
        if ($throwable instanceof ApiException) {
            return $this->handleApiException($throwable);
        }

        if ($throwable instanceof NotFoundHttpException) {
            return $this->handleNotFoundHttpException($throwable);
        }

        if ($throwable instanceof ValidationException) {
            return $this->handleValidationException($throwable);
        }

        return parent::render($request, $throwable);
    }

    private function handleApiException(ApiException $throwable)
    {
        $statusCode = $throwable->getStatusCode();
        $message = $throwable->getMessage();

        return new JsonResponse(['error' => $message], $statusCode);
    }

    private function handleNotFoundHttpException(NotFoundHttpException $throwable)
    {
        return new JsonResponse(['error' => 'Not found'], JsonResponse::HTTP_NOT_FOUND);
    }

    private function handleValidationException(ValidationException $throwable)
    {
        $errors = $throwable->errors();

        return new JsonResponse(['errors' => $errors], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
    }
}
