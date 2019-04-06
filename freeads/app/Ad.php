<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $fillable = [
        'title',
        'details',
        'photo',
        'photo2',
        'photo3',
        'price',
        'id_user',
        'category'     
    ];
}
