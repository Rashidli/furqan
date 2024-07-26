<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeTranslation extends Model
{

    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['title','value','office_id','locale'];

}
