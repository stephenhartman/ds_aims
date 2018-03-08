<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Session;
use Jrean\UserVerification\Exceptions\UserNotVerifiedException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [

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
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $exception
     * @return void
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        if (app()->bound('sentry') && $this->shouldReport($exception)) {
            app('sentry')->captureException($exception);
        }
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof \Illuminate\Http\Exceptions\PostTooLargeException) {
            session()->flash('error', 'The file size is too large, please limit your file to 2 MB');
            return redirect()->back();
        }

        if ($exception instanceof UserNotVerifiedException) {
            return response()->view('auth.errors.not-verified', [], 401); //  <----- The magic
        }

        if ($exception instanceof \ErrorException) {
            session()->flash('error', 'You must log in to view this page');
            return redirect('login');
        }
        return parent::render($request, $exception);
    }
}
