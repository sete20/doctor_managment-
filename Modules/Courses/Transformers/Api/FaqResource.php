<?php

namespace Modules\Courses\Transformers\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Category\Transformers\Dashboard\CategoryResource;
use Modules\Doctors\Transformers\Dashboard\DoctorResource;

class FaqResource extends JsonResource
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
            'Answers_count' => $this->answers()->Active()->count(),
            'photo' => $this->getFirstMediaUrl('image') == '' ? null : $this->getFirstMediaUrl('image'),
            'Answers' => AnswerResource::collection($this->answers()->Active()->get()),
            'user_answer_data' => $this->user_answer
        ];
    }
}
