<?php

namespace Modules\Authorization\Transformers\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
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
           'name'          => $this->name,
           'display_name'  => $this->display_name,
           'description'   => $this->description,
           'created_at'    => date('d-m-Y' , strtotime($this->created_at)),
       ];
    }
}
