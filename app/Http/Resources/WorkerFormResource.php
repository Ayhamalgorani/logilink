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
            "id" => $this->id, 
            "name" => $this->name, 
            "email" => $this->email,
            "phone_number" => $this->phone_number,
            "service_id" => $this->service, 
            "gender" => $this->gender,
            "birth_date" => $this->birth_date,
            "file" => asset('storage/files/' . $this->file),
            "image" =>asset('storage/images/' . $this->image),
            "country_id" => $this->country_id,
            "terms" => $this->is_terms_agreed,
        ];
    }
}