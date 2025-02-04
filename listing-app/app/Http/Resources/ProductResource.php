<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => ucfirst($this->name), // Capitalize name
            'price' => number_format($this->price), // Format price with 2 decimal places
            'category' => strtoupper($this->category), // Convert category to uppercase
        ];
    }
}
