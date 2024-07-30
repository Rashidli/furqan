<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VacancyResource extends JsonResource
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
            'title' => $this->title,
            'branch' => $this->branch,
            'description' => $this->description,
            'requirement' => $this->requirement,
            'email' => $this->email,
            'phone' => $this->phone,
            'slug' => $this->slug
        ];
    }
}
