<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
        //Asignacion masiva
    protected $guarded = ['id'];

    const ACTIVE = 1;
    const INACTIVE = 2;
    const PENDING = 3;
}
