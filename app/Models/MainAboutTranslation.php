<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainAboutTranslation extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['description','main_about_id','locale'];
}
