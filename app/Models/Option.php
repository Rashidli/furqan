<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Option extends Model
{
    use HasFactory, Translatable, SoftDeletes;
    public $translatedAttributes = ['title'];
    protected $fillable = ['is_active','image'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function filter()
    {
        return $this->belongsTo(Filter::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'option_product', 'option_id', 'product_id');
    }

}
