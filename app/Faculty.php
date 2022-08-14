<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $fillable = ['name', 'code', 'abbreviation', 'description'];
    protected $dates = ['created_at', 'updated_at'];
}
