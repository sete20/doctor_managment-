<?php

namespace Modules\Setting\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Setting\Http\Requests\Dashboard\SettingRequest;
use Modules\Setting\Repositories\Dashboard\SettingRepository as Setting;

class SettingController extends Controller
{
    private $setting;

    function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }

    public function index()
    {
        return view('setting::dashboard.index');
    }

    public function update(SettingRequest $request)
    {
        $this->setting->set($request);
        return back()->with("success",__('app::dashboard.messages.updated'));
    }

}
