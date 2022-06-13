<?php
namespace Modules\Notifications\Transformers\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationLiteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'is_read' => $this->pivot->is_read,
            'type' => $this->type,
        ];
    }
}
