<?php

namespace Modules\Log\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\Dashboard\CrudDashboardController;

class LogController extends Controller
{
    use CrudDashboardController;
}
