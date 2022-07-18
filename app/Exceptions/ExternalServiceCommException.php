<?php

namespace App\Exceptions;

use Illuminate\Http\Response;

class ExternalServiceCommException extends ApplicationException
{
    public function status(): int
    {
        return Response::HTTP_BAD_GATEWAY;
    }

    public function error(): string
    {
        return trans("exception.external_service_error.error");
    }
}
