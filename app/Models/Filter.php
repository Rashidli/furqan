<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Filter extends Model
{

    use HasFactory, Translatable, SoftDeletes;
    public $translatedAttributes = ['title'];
    protected $fillable = ['is_active'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'filter_product_option')->withPivot('option_id')->withTimestamps();
    }

}
