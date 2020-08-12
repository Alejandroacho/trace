<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Role extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'role_name'=>$this->role_name
        ];
    }
}