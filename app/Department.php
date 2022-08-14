<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['faculty_code', 'name', 'code', 'abbreviation', 'description'];
    protected $dates = ['created_at', 'updated_at'];
}
