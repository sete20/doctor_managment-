<?php

namespace Modules\Users\Http\Controllers\Dashboard;

use Helper\NotificationHelper;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\Dashboard\CrudDashboardController;
use Modules\Users\Entities\Client;
use Modules\Users\Http\Requests\Dashboard\ClientNotificationRequest;

class ClientController extends Controller
{
    use CrudDashboardController;

    public function notificationView()
    {
        return $this->view('notification');
    }

    public function sendNotification(ClientNotificationRequest $request)
    {
        $ids = $request->clients && count($request->clients) ? $request->clients : Client::pluck('id')->toArray();

        if($request->courses && count($request->courses)){
            $ids = Client::whereHas('courses' , function ($q) use ($request,$ids){
                $q->whereIn('courses.id' , $request->courses);
            })->whereIn('id' , $ids)->pluck('id')->toArray();
        }

        NotificationHelper::sendNotification(auth('admin')->user(),$ids, 'clients',$request->title,$request->body);
        return Response()->json([true, __('app::dashboard.messages.sent')]);
    }
}
