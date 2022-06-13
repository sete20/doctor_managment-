<?php

namespace Modules\Courses\Transformers\Doctor;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientCourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'client_id' => optional($this->client)->name,
            'course_id' => optional($this->course)->title,
            'price' => $this->price,
            'offer_price' => $this->offer_price,
            'is_offered' => $this->is_offered,
            'created_at'    => date('d-m-Y' , strtotime($this->created_at)),
        ];
    }
}
