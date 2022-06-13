<?php

namespace Modules\Users\Transformers\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'status' => $this->activation,
            'points' => $this->points,
            'created_at' => date('d-m-Y', strtotime($this->created_at)),
            'options' => view('users::dashboard.clients.components.table-options', ['model' => $this])->render(),
        ];
    }
}
