<?php


namespace Modules\Auth\Repositories\Dashboard;


use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;

class LoginRepository
{
    public $guard = 'admin';

    public static function authentication($credentials, $guard)
    {
        // LOGIN BY : Mobile & Password
        if (is_numeric($credentials->email)):

            $auth = Auth::guard($guard)->attempt([
                'mobile' => $credentials->email,
                'password' => $credentials->password
            ], $credentials->has('remember')
            );

        // LOGIN BY : Email & Password

        elseif (filter_var($credentials->email, FILTER_VALIDATE_EMAIL)):
            $auth = Auth::guard($guard)->attempt([
                'email' => $credentials->email,
                'password' => $credentials->password
            ],
                $credentials->has('remember')
            );
        endif;

        return $auth;
    }

    public function login($credentials)
    {
        try {

            if (self::authentication($credentials , $this->guard))
                return false;

            $errors = new MessageBag([
                'password' => __('auth::dashboard.login.validations.failed')
            ]);

            return $errors;

        } catch (Exception $e) {

            return $e;

        }
    }
}