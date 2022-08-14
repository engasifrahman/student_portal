<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['code', 'title', 'credit', 'cost', 'description'];
    protected $dates = ['created_at', 'updated_at'];
}
