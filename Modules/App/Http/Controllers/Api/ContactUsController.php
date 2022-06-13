<?php

namespace Modules\App\Http\Controllers\Api;

use Notification;
use Illuminate\Http\Request;

class ContactUsController extends ApiController
{
    public function send(ContactUsRequest $request)
    {
        Notification::route('mail', setting('contact_us','email'))
        ->notify((new ContactUsNotification($request))->locale(locale()));

        return $this->response([]);
    }
}
