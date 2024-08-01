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
        return [
            'id' => $this->id,
            'status' =>$this->status,
            'items_count' =>$this->items_count,
            'total_price' =>$this->total_price,
            'order_date' => $this->created_at->format('d.m.Y'),
            'order_items' => OrderItemResource::collection($this->items),
        ];
    }
}
