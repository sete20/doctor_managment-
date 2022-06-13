<?php

namespace Modules\Notifications\Repositories\Api;

use Illuminate\Http\Request;
use Modules\Courses\Entities\ClientCourse;
use Modules\Courses\Entities\Course;
use Illuminate\Support\Facades\DB;

class NotificationRepository
{
    private $notification;

    function __construct(Course $notification)
    {
        $this->notification = $notification;
    }

    public function findById($id)
    {
        $notifications = $this->notification->find($id);
        return $notifications;
    }

    public function getPagination($request)
    {
        $paginate = $request->paginate_number ? $request->paginate_number : 10;
        $notifications = $request->user('api-client')->notifications()->where(function ($q) use ($request) {

            if ($request->notification_id) {

                $q->where('notification_id', $request->notification_id);

            }else{

                if($request->type) {
                        $q->where('is_read' , ($request->type == 'new' ? 0 : 1));
                }
            }

        })->latest()->paginate($paginate);
        return $notifications;
    }


    public function delete($id  , $user)
    {
        $notification = $user->notifications()->find($id);

        if (!$notification)
            return false;

        $notification->clients()->detach($user->id);

        if (!$notification->clients()->count())
            $notification->delete();

        return true;
    }

    public function read($id  , $user)
    {
        $notification = $user->notifications()->find($id);

        if (!$notification)
            return false;

        $notification->clients()->updateExistingPivot($user->id, ['is_read' => 1]);

        return true;
    }

    public function unRead(Request $request)
    {
        $user = $request->user('api-client');
        return $user->notifications()->where('is_read' , 0);
    }
}
