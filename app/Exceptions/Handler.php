<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Throwable;

class Handler extends ExceptionHandler
{
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
            //
            Log::error($e);
        });
        

        // if ($this->isHttpException($exception)) {
        //     // Pass additional data to the view
        //     $errorCode = $exception->getStatusCode();

        //     // Return a response with the view and the status code
        //     // return response()->view('errors.custom', ['errorCode' => $errorCode], $errorCode);
        // }



        
    }
}
