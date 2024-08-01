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
            'title' => $this->title,
            'content' => $this->description,
            'category_name' => $this->parentCategory?->title,
            'parent_category_id' =>$this->parent_category_id,
            'img' => url('/') . '/storage/' . $this->image,
            'price' => $this->price,
            'discounted_price' => $this->discounted_price,
            'is_favorite' => $this->is_favorite,
            'is_in_cart' => $this->is_in_cart,
            'is_stock' => $this->is_stock,
            'is_popular' => $this->is_popular,
            'is_new' => $this->is_new,
            'slug' => $this->slug,
            'images' => ImageResource::collection($this->product_images),
            'modules' => ModuleResource::collection($this->modules),
            'options' => OptionResource::collection($this->options),
        ];
    }
}
//        "id": 15,
//        "parent_category_id": 12,
//        "category_id": 11,
//        "image": "81fd5f7c-238e-4c82-a56c-48bf3d30f664.webp",
//        "is_active": 1,
//        "is_popular": 0,
//        "is_stock": 0,
//        "created_at": "2024-07-29T08:37:37.000000Z",
//        "updated_at": "2024-07-29T09:24:49.000000Z",
//        "deleted_at": null,
//        "is_favorite": true,
//        "title": "dfbdfbfdbfd",
//        "description": "<p>fdbfdbfdb</p>",
//        "slug": "dfbdfbfdbfd-1",
