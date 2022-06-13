<?php

namespace App\Http\Middleware\Api;

use Closure;
use Helper\Helper;
use Helper\Response;
use Helper\Translation;

class ClientActivation
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        if (auth('api-client')->check()) {

            // check user confirmation and activation
            ///
            $client = auth('api-client')->user();
            if ($client->activation == 'pending') {

                return Response::responseJson(0, ('please confirm your account first'));

            } elseif ($client->activation == 'deactivate' || $client->screen_shot_num >= 3) {

                return Response::responseJson(0, ('You have been banned from use. You can contact the administration'));

            }
            ///
            ///////////////////
        }


        return $next($request);
    }
}
