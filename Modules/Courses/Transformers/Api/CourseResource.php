<?php

namespace Modules\Courses\Transformers\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Category\Transformers\Dashboard\CategoryResource;
use Modules\Doctors\Transformers\Dashboard\DoctorResource;

class CourseResource extends JsonResource
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
            'note' => $this->translate(locale())->note,
            'image' => $this->getFirstMediaUrl('images'),
            'price' => $this->price,
            'offer_price' => $this->offer_price,
            'is_offered' => $this->is_offered,
            'client_complete_percentage' => $this->client_complete_percentage,
            'videos_count' => $this->videos_count,
            'complete_status' => $this->complete_status,
            'quiz_count' => $this->quiz_count,
            'card_count' => $this->card_count,
            'client_status' => $this->client_status,
            'category' => optional($this->category->translate(locale()))->title,
            'doctor' => $this->doctor->name,
            'course_intro_video' => $this->getFirstMediaUrl('intro_video'),
        ];
    }
}
