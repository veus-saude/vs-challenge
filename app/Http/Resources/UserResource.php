<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        $data = $this->resource->toArray();
        $resource = [
            'id' => Arr::get($data,'id'),
            'name' => Arr::get($data,'name'),
            "email" => Arr::get($data,'email')
        ];

        return $resource;
    }
}
