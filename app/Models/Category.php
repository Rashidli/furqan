<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{

    use HasFactory, Translatable, SoftDeletes;
    public $translatedAttributes = ['title','slug'];
    protected $fillable = ['parent_id','image','row'];

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('id','desc');
    }

    public function products()
    {
        return $this->hasMany(Product::class)->where('is_active',true);
    }

}
