<?php

namespace App\Exceptions;
use Illuminate\Http\JsonResponse;

use Exception;

class ApiException extends Exception
{
    /**
     * Get the HTTP status code associated with the exception.
     *
     * @return int
     */
    public function getStatusCode()
    {
        return JsonResponse::HTTP_INTERNAL_SERVER_ERROR;
    }
}
