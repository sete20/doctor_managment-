<?php

namespace Modules\App\Http\Controllers\Doctor;

use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('app::dashboard.doctor-index');
    }
}
