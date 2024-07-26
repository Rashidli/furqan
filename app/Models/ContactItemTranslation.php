<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactItemTranslation extends Model
{

    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['title','value','contact_item_id','locale'];

}
