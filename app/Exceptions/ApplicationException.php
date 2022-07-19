<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

abstract class ApplicationException extends Exception
{
    public function render(Request $request): Response
    {
        $error = new Error($this->error());
        return response($error->toArray(), $this->status());
    }

    abstract public function error(): string;

    abstract public function status(): int;
}
