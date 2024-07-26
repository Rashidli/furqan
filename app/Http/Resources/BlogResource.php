<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
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
            'content' => $this->description,
            'img' => $url . '/storage/' . $this->image,
            'created_at' => $this->created_at->format('m/d/Y'),
            'slug' => $this->slug
        ];
    }
}
