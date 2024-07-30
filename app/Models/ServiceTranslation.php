<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceTranslation extends Model
{

    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['title','description','service_id','locale','slug'];

}
