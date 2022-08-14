<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Semester;
use App\CourseReg;

class FMRegCourseController extends Controller
{
    public function __construct() {
        $this->middleware('FMAuth');
    }

    public function index()
    {
        $semesters = Semester::orderBy('id', 'DESC')->get();
        return view('fmregcourse.index', compact('semesters'));
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
    				$j += $key;
    				$regdetails[$j]['course_code'] = $course->code;
    				$regdetails[$j]['course_title'] = $course->title;
    				$regdetails[$j]['course_credit'] = $course->credit;
    				$regdetails[$j]['section'] = $coursereg[$i]->section;
    			}
    		}
    		$data = (object) array();
    		$data = $regdetails;
    		return view('fmregcourse.view', compact('data'));
    	}
    	else
    	{
    		return response()->json(['message'=>'invalid']);;
    	}
    }
}
