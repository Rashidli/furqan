<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VacancyTranslation extends Model
{

    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['title','description','vacancy_id','locale','slug','branch','requirement'];

}
