<?php

namespace App\Exceptions;

use ErrorException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = ["current_password", "password", "password_confirmation"];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        if ($e instanceof ModelNotFoundException) {
            $replacement = [
                "id" => collect($e->getIds())->first(),
                "model" => Arr::last(explode("\\", $e->getModel())),
            ];

            $error = new Error($e->getMessage(), trans("exception.model_not_found.error", $replacement));

            return response($error->toArray(), Response::HTTP_NOT_FOUND);
        } elseif ($e instanceof ExternalServiceCommException) {
            $error = new Error($e->error());

            return response($error->toArray(), $e->status());
        } elseif ($e instanceof ErrorException) {
            $error = new Error($e->getMessage(), trans("exception.error_exception.error"));

            return response($error->toArray(), Response::HTTP_INTERNAL_SERVER_ERROR);
        } else {
            $error = new Error($e->getMessage(), trans("exception.error_exception.error"));

            return response($error->toArray(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return parent::render($request, $e);
    }
}
