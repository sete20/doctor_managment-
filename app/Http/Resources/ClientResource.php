<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */

    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'name'         => $this->name,
            'phone'         => $this->phone,
            'email'         => $this->email,
            'points'         => 0,
            'image'         => $this->getFirstMediaUrl('images') ?? null,
            'university'         => $this->university,
            'college'         => $this->name,
            'image'         => $this->getMedia('images') ? $this->getMedia('images')[0]->getFullUrl() : null
        ];
    }
}
