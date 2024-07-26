<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TestimonialResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $url = url('/');
        return [
            'id' => $this->id,
            'title' => $this->title,
            'position' => $this->position,
            'content' => $this->description,
            'img' => $url . '/storage/' . $this->image,
            'bg_img' => $url . '/storage/' . $this->bg_image
        ];
    }
}
