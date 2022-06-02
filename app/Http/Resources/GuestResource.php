<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class GuestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'id' => $this->id,
            'externalId' => $this->external_id,
            'name' => $this->name,
            'phone' => $this->phone,
            'side' => $this->side ?? '',
            'gender' => $this->gender ?? '',
            'arrivedAt' => $this->when($this->arrived_at, fn() => $this->arrived_at->toDateTimeString(), 'n/a'),
        ];
    }
}
