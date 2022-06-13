<?php

namespace Modules\App\Http\Controllers\Api;


use Illuminate\Http\Request;
use Modules\App\Entities\Home;
use Modules\App\Transformers\Api\HomeResource;

class HomeController extends ApiController
{
    public function index(Request $request)
    {
        $home = Home::active()->orderBy('order')->paginate(5);

        return (HomeResource::collection($home))->additional([
            'status' => 1,
            'message' => 'تم التحميل',
        ]);
    }
}
