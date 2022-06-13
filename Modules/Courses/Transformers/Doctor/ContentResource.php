<?php

namespace Modules\Courses\Transformers\Doctor;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Category\Transformers\Dashboard\CategoryResource;
use Modules\Doctors\Transformers\Dashboard\DoctorResource;

class ContentResource extends JsonResource
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
            'title' => $this->translate(locale())->title,
            'description' => $this->translate(locale())->description,
            'chapter_id' => optional($this->chapter->translate(locale()))->title,
            'course' => optional($this->chapter->course->translate(locale()))->title,
            'type' => $this->type,
            'status' => $this->status,
            'deleted_at'    => $this->deleted_at,
            'created_at' => date('d-m-Y', strtotime($this->created_at)),
        ];
    }
}
