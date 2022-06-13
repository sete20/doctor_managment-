<?php

namespace Modules\Courses\Transformers\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Category\Transformers\Dashboard\CategoryResource;
use Modules\Doctors\Transformers\Dashboard\DoctorResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
           'id'            => $this->id,
           'title'         => $this->translate(locale())->title,
           'description'         => $this->translate(locale())->description,
           'note'         => $this->translate(locale())->note,
           'image'         => $this->getFirstMediaUrl('images'),
           'status'        => $this->status,
           'price'        => $this->price,
           'offer_price'        => $this->offer_price,
           'is_offered'        => $this->is_offered,
           'deleted_at'    => $this->deleted_at,
           'created_at'    => date('d-m-Y' , strtotime($this->created_at)),
            'category'         => optional($this->category->translate(locale()))->title,
            'doctor'         => $this->doctor->name,
       ];
    }
}
