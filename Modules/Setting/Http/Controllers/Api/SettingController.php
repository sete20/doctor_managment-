<?php

namespace Modules\Setting\Http\Controllers\Api;

use Helper\Response;
use Illuminate\Http\Request;
use Modules\App\Http\Controllers\Api\ApiController;

class SettingController extends ApiController
{

    public function terms()
    {
        return Response::responseJson(1, 'success', ['url' => url('/')]);
    }

    public function settings($type)
    {
        $settings = setting($type);
        return Response::responseJson(1, 'success', $settings);
    }

    public function countries()
    {
        $counties = config('api_setting.countries_phone_code');

        return $this->response($counties);
    }

    public function langues(Request $request)
    {
        return $this->response($this->responseLnagues());
    }

    public function responseLnagues()
    {
        $res = [];
        foreach (config('laravellocalization.supportedLocales') as $key => $value) {
            array_push(
                $res, [
                    "code" => $key,
                    "name" => $value["name"],
                    "native" => $value["native"]
                ]
            );
        }
        return $res;

    }


}
