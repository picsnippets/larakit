<?php

namespace Buckii\Larakit\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Buckii\Larakit\Models\Error;
use Exception;

class Handler extends ExceptionHandler
{
    public function render($request, Exception $exception)
    {
        Error::report($exception, $request);

        return parent::render($request, $exception);
    }
}
