<?php

namespace Modules\Notifications\Transformers\Api;

use Illuminate\Support\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */

    public function toArray($request)
    {
        $resource = $this->resources;
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'is_read' => $this->pivot->is_read,
            'time' => Carbon::parse($this->created_at)->toTimeString(),
            'date' => Carbon::parse($this->created_at)->toDateString(),
            'type' => $this->type,
            'data' => $this->is_general ? (object)[] : new $resource($this->notifiable),
        ];
    }
}
