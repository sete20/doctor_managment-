<?php

namespace Modules\App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ApiController extends Controller
{
    public function response($result, $message = 'Successfully')
    {
        $response = [
            'success' => true,
            'data' 		=> $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }

    public function error($error, $errorMessages = [], $code = 200)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }

    public function invalidData($error, $errorMessages = [], $code = 422)
    {
        $response = [
            'message' => 'The given data was invalid.',
            'errors' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }

}
