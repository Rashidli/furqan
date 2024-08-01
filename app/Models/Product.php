<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{

    use HasFactory, Translatable, SoftDeletes;
    public $translatedAttributes = ['title','description','slug'];
    protected $fillable = [
        'image',
        'is_new',
        'is_active','brand_id',
        'category_id','parent_category_id',
        'is_popular','is_stock','discounted_price',
        'price','discount_percent'
    ];
    protected $casts = [
        'is_stock' => 'boolean',
        'is_popular' => 'boolean',
        'is_new' => 'boolean',
    ];
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
    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_category_id');
    }

    public function modules()
    {
      return $this->hasMany(Module::class);
    }

    public function options()
    {
        return $this->belongsToMany(Option::class, 'option_product', 'product_id', 'option_id');
    }

    // for favorites
    protected $appends = ['is_favorite', 'is_in_cart'];

    public function favoritedBy()
    {
        return $this->belongsToMany(Customer::class, 'favorites', 'product_id', 'customer_id');
    }

    public function getIsFavoriteAttribute()
    {
        $customer = Auth::guard('api')->user();
        if ($customer) {
            return $this->favoritedBy()->where('customer_id', $customer->id)->exists();
        }

        return false;
    }

    // cart section
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function getIsInCartAttribute()
    {
        $customer = Auth::guard('api')->user();
        if ($customer) {
            return $this->cartItems()->where('cart_id', $customer->cart?->id)->exists();
        }

        return false;
    }

}
