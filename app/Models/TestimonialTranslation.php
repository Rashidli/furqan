<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestimonialTranslation extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['title','description','testimonial_id','locale','position'];
}
