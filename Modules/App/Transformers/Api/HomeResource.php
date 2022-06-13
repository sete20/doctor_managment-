<?php

namespace Modules\App\Transformers\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Category\Transformers\Dashboard\CategoryResource;
use Modules\Courses\Transformers\Api\CourseResource;
use Modules\Doctors\Transformers\Dashboard\DoctorResource;

class HomeResource extends JsonResource
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
            'title' => $this->title,
            'courses' => CourseResource::collection($this->courses()->active()->take(5)->get()),
        ];
    }
}
