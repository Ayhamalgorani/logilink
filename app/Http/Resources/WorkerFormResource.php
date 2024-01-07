<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkerFormResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "name" => $this->name, 
            "email" => $this->email,
            "phone_number" => $this->phone_number,
            "service_id" => $this->service, 
            "gender" => $this->gender,
            "birth_date" => $this->birth_date,
            "location" => $this->location,
            "file" => $this->file,
            "image" => $this->image,
            "terms" => $this->is_terms_agreed,
        ];
    }
}