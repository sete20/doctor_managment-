<?php

namespace Modules\Courses\Transformers\Doctor;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Category\Transformers\Dashboard\CategoryResource;
use Modules\Doctors\Transformers\Dashboard\DoctorResource;

class ChapterResource extends JsonResource
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
            'status' => $this->status,
            'order' => $this->order,
            'deleted_at' => $this->deleted_at,
            'created_at' => date('d-m-Y', strtotime($this->created_at)),
            'course_id' => optional($this->course->translate(locale()))->title,
        ];
    }
}
