<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'userId'        => $this->id,
            'name'          => $this->name,
            'email'         => $this->email,
            'country'       => $this->country,
            'currency'      => $this->currency
        ];
    }
}
