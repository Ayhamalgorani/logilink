<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkerProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'service_id' =>$this->service_id,
            "name" => $this->name,
            "email" => $this->email,
            "birth_date" => $this->birth_date,
            "gender" => $this->gender,
            "phone_number" => $this->phone_number,
            "location" => $this->location,

        ];
    }
}