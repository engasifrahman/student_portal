<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Course;
use App\Semester;
use App\CourseReg;
use App\StudResult;

class LiveResultController extends Controller
{
    public function __construct() {
        $this->middleware('StudAuth');
    }

    public function index()
    {
        $semesters = Semester::orderBy('id', 'DESC')->get();
        return view('liveresult.index', compact('semesters'));
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
    				$regdetails[$j]['user_id'] = $coursereg[$i]->user_id;
    				$regdetails[$j]['dept_code'] = $coursereg[$i]->dept_code;
    				$regdetails[$j]['sem_code'] = $coursereg[$i]->sem_code;
    				$regdetails[$j]['section'] = $coursereg[$i]->section;
    				$regdetails[$j]['teacher'] = $teacher;
    			}
    		}
    		$data = (object) array();
    		$data = $regdetails;
    		return view('liveresult.view', compact('data'));
    	}
    	else
    	{
    		return response()->json(['message'=>'invalid']);;
    	}
    }

    public function live_result(Request $request )
    {
    	if (isset($request->course_details))
    	{
    		$course_details = explode('=', $request->course_details);
    		if (sizeof($course_details) == 5)
    		{
    			$data = StudResult::where('stud_id',  $course_details[0])->where('dept_code', $course_details[1])->where('sem_code', $course_details[2])->where('course_code', $course_details[3])->where('section', $course_details[4])->select('ct_1', 'ct_2', 'ct_3', 'avg_ct', 'midterm')->first();

    			return compact('data');
    		}
    		else
    		{
    			return response()->json(['message'=>'Something went wrong.'], 420);
    		}
    	}
    	else
        {
            return response()->json(['message'=>'Something went wrong.'], 420);
        }
    }

}
