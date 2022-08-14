<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $fillable = ['name', 'description'];
    protected $dates = ['created_at', 'updated_at'];
}
