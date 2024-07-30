<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{

    use HasFactory, Translatable, SoftDeletes;
    public $translatedAttributes = ['title','description','slug'];
    protected $fillable = ['image','is_active','brand_id','category_id','parent_category_id','is_popular','is_stock'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function product_images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function modules()
    {
      return $this->hasMany(Module::class);
    }

    public function options()
    {
        return $this->belongsToMany(Option::class, 'option_product', 'product_id', 'option_id');
    }

}
