<?php

namespace Modules\Notifications\Http\Controllers\Api;

use Helper\Response;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Notifications\Repositories\Api\NotificationRepository;
use Modules\Notifications\Transformers\Api\NotificationResource;

class NotificationsController extends Controller
{
    private $notification_repo;

    public function __construct(NotificationRepository $notification_repo)
    {
        $this->notification_repo = $notification_repo;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $notifications = $this->notification_repo->getPagination($request);

        return (NotificationResource::collection($notifications))->additional([
            'status' => 1,
            'message' => 'تم التحميل',
        ]);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function read(Request $request)
    {
        $user = $request->user('api-client');
        $data = validator()->make($request->all(), [
            'notification_id' => 'required|exists:notifications,id'
        ]);

        if ($data->fails())
            return Response::responseJson(0, $data->errors()->first());

        $notification  = $this->notification_repo->read($request->notification_id , $user);

        if($notification) {
            return Response::responseJson(1,'success');
        }else{
            return Response::responseJson(0,'notification not found');
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request)
    {
        $user = $request->user('api-client');
        $data = validator()->make($request->all(),
            [
                'notification_id' => 'required|exists:notifications,id'
            ]);

        if ($data->fails())
            return Response::responseJson(0, $data->errors()->first());

        $notification  = $this->notification_repo->delete($request->notification_id , $user);

        if($notification) {
            return Response::responseJson(1,'success');
        }else{
            return Response::responseJson(0,'notification not found');
        }
    }


}
