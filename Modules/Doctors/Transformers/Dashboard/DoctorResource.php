<?php

namespace Modules\Doctors\Transformers\Dashboard;


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
           'email'         => $this->name,
           'image'         => asset($this->image),
           'status'        => $this->status,
           'deleted_at'    => $this->deleted_at,
           'created_at'    =>  Carbon::parse($this->created_at)->toDateTimeString(),
       ];
    }
}
