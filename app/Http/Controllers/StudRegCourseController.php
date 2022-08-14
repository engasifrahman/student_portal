<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Course;
use App\Semester;
use App\CourseReg;

class StudRegCourseController extends Controller
{
    public function __construct() {
        $this->middleware('StudAuth');
    }

    public function index()
    {
        $semesters = Semester::orderBy('id', 'DESC')->get();
        return view('studregcourse.index', compact('semesters'));
    }

    public function dynamic(Request $request)
    {
    	if (isset($request->user_id) && isset($request->sem_code)) 
    	{
    		$coursereg = CourseReg::join('departments', 'dept_code', 'departments.code')->where('user_id', $request->user_id)->where('sem_code', $request->sem_code)->select('course_regs.*', 'departments.abbreviation AS department')->get();

    		$j = 0;
    		$regdetails = [];
    		for($i=0; $i < sizeof($coursereg); $i++)
    		{
    			$course_codes = explode(', ', $coursereg[$i]->course_code);
    			$course_details = Course::whereIn('code', $course_codes)->select('code', 'title', 'credit')->get();

    			foreach ($course_details as $key => $course) 
    			{
    				$teacher = CourseReg::join('users', 'users.user_id', 'course_regs.user_id')->where('users.type', 'Faculty Member')->where('course_regs.dept_code', $coursereg[$i]->dept_code)->where('course_regs.sem_code', $coursereg[$i]->sem_code)->where('section', $coursereg[$i]->section)->where('course_code', 'LIKE', '%'.$course->code.'%')->select('users.name AS name')->first();
    				if (isset($teacher)) 
    				{
    				 	$teacher = $teacher->name;
    				}
    				else
    				{
    				 	$teacher = '';
    				}

    				$j += $key;
    				$regdetails[$j]['course_code'] = $course->code;
    				$regdetails[$j]['course_title'] = $course->title;
    				$regdetails[$j]['course_credit'] = $course->credit;
    				$regdetails[$j]['section'] = $coursereg[$i]->section;
    				$regdetails[$j]['teacher'] = $teacher;
    			}
    		}
    		$data = (object) array();
    		$data = $regdetails;
    		return view('studregcourse.view', compact('data'));
    	}
    	else
    	{
    		return response()->json(['message'=>'invalid']);;
    	}
    }
}
