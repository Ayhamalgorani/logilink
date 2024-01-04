<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
    
    
        return [
            'order' => [
                'location' => $this->orders->location,
                'date' => $this->orders->date,
                'time' => $this->orders->time,
                'description' => $this->orders->description,
                'images' => $this->orders->images,
            ],
            'worker_info' => 
            [
                'name' => $this->user->name,
                'location' =>$this->user->location,
                'email' =>$this->user->email,
                'phone_number' =>$this->user->phone_number,  
                'gender' =>$this->user->gender,  
                'birth_date' =>$this->user->birth_date,  
            ],  
            'price' => $this->price,
        ];
    }
}