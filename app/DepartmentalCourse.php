<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepartmentalCourse extends Model
{
    protected $fillable = ['dept_code', 'course_code'];
    protected $dates = ['created_at', 'updated_at'];
    //protected $table = 'departmental_courses';
}
