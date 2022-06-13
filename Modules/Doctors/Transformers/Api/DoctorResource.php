<?php

namespace Modules\Doctors\Transformers\Api;


use Illuminate\Support\Carbon;
use Illuminate\Http\Resources\Json\JsonResource as Resource;

class DoctorResource extends Resource
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
           'name'         => $this->name,
           'image'         => $this->image ? asset($this->image) : null,
       ];
    }
}
