<?php

namespace App\Http\Resources;

use AutoSwagger\Attributes\ApiSwaggerResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

#[ApiSwaggerResource(name: 'user', description: 'User', properties: [
    "name" => "string",
    "email" => "string",
])]
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->resource->name,
            'email' => $this->resource->email,
        ];
    }
}
