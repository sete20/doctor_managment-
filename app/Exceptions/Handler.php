<?php

namespace App\Exceptions;

use Helper\Helper;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
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
        'current_password',
        'password',
        'password_confirmation',
    ];

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


    protected function unauthenticated($request, AuthenticationException $exception)
    {
        $guard = \Arr::get($exception->guards(), 0);

        if ($request->expectsJson() || in_array($guard , ['api-client'])) {
            return Helper::responseJson(0 ,'Un Authenticated');
        }

        switch ($guard) {
            case 'admin':
                $login = 'dashboard.login';
                break;
            case 'doctor':
                $login = 'doctor.login';
                break;

            default:
                $login = 'login';
                break;
        }

        return redirect()->route($login);
    }
}
