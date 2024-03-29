<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // $images = [];
        // foreach ($this?->images as $image) {
        //     $images[] = asset('storage/images/' . $image);
        // }


        
        return [
            'id' => $this->id,
            'name' => $this->user->name,
            'location' => $this->location,
            'date' => $this->date,
            'time' => $this->time,
            'description' => $this->description,
            'status' => $this->status,
            'images' => $this->images,
        ];
    }
}
