<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Course;
use App\Section;
use App\Faculty;
use App\Semester;
use App\CourseReg;
use App\TutionFee;
use App\StudResult;
use App\Department;
use App\DepartmentalCourse;

class StudResultController extends Controller
{
    public function __construct() {
        $this->middleware('FMAuth');
    }

    public function index()
    {
        $semesters = Semester::orderBy('id', 'DESC')->get();
        return view('studresult.index', compact('semesters'));
    }

    public function dynamic(Request $request)
    {
    	if (isset($request->user_id) && isset($request->sem_code))
    	{
    		$coursereg = CourseReg::join('departments', 'dept_code', 'departments.code')
            ->where('user_id', $request->user_id)
            ->where('sem_code', $request->sem_code)
            ->select('course_regs.*', 'departments.abbreviation AS department')
            ->get();

            // dd($coursereg->toJson(JSON_PRETTY_PRINT));

    		$j = 0;
    		$regdetails = [];
    		for($i=0; $i < sizeof($coursereg); $i++)
    		{
    			$course_codes = explode(', ', $coursereg[$i]->course_code);
    			$course_details = Course::whereIn('code', $course_codes)->select('code', 'title')->get();

    			foreach ($course_details as $key => $course)
    			{
    				$j += $key;
    				$regdetails[$j]['course_code'] = $course->code;
    				$regdetails[$j]['course_title'] = $course->title;
    				$regdetails[$j]['department'] = $coursereg[$i]->department;
    				$regdetails[$j]['dept_code'] = $coursereg[$i]->dept_code;
    				$regdetails[$j]['sem_code'] = $coursereg[$i]->sem_code;
    				$regdetails[$j]['section'] = $coursereg[$i]->section;
    			}
    		}
    		$regDetails = (object) array();
    		$regDetails = $regdetails;
    		return compact('regDetails');
    	}
    	else
    	{
    		return response()->json(['message'=>'invalid']);;
    	}
    }

    public function search(Request $request )
    {
    	if (isset($request->course_details))
    	{
    		$course_details = explode('-', $request->course_details);
    		if (sizeof($course_details) == 4)
    		{
    			return view('studresult.result', ['viewData'=> $request->course_details]);
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

    public function view(Request $request)
    {
    	$course_details = explode('-', $request->user_id);
      	$data = StudResult::where('sem_code', $course_details[0])->where('dept_code', $course_details[1])->where('course_code', $course_details[2])->where('section', $course_details[3])->get();

    	return view('studresult.view', compact('data'), ['viewData'=> $request->user_id]);
    }

    public function edit($id)
    {
        $editData = StudResult::find($id);
        return compact('editData');
    }

    public function update(Request $request, $id)
    {

        $this->validate($request,[
            'attendance'	=>'nullable|min:0|max:7|numeric',
            'ct_1'			=>'nullable|min:0|max:15|numeric',
            'ct_2'			=>'nullable|min:0|max:15|numeric',
            'ct_3'			=>'nullable|min:0|max:15|numeric',
            'presentation'	=>'nullable|min:0|max:8|numeric',
            'assignment'	=>'nullable|min:0|max:5|numeric',
            'midterm'		=>'nullable|min:0|max:25|numeric',
            'final'			=>'nullable|min:0|max:40|numeric',
        ]);

        $studresult = StudResult::find($id);

        if (!empty($request->attendance))
        {
        	$studresult->attendance = $request->attendance;
        }
        if (!empty($request->ct_1))
        {
        	$studresult->ct_1 = $request->ct_1;
        }
        if (!empty($request->ct_2))
        {
        	$studresult->ct_2 = $request->ct_2;
        }
        if (!empty($request->ct_3))
        {
        	$studresult->ct_3 = $request->ct_3;
        }
        if (!empty($request->presentation))
        {
        	$studresult->presentation = $request->presentation;
        }
        if (!empty($request->assignment))
        {
        	$studresult->assignment = $request->assignment;
        }
        if (!empty($request->midterm))
        {
        	$studresult->midterm = $request->midterm;
        }
        if (!empty($request->final))
        {
        	$studresult->final = $request->final;
        }

        $studresult->avg_ct = ($studresult->ct_1 + $studresult->ct_2 + $studresult->ct_3) / 3;

        $studresult->total = $studresult->attendance + $studresult->avg_ct + $studresult->presentation + $studresult->assignment + $studresult->midterm + $studresult->final;

        if ($studresult->total >= 80)
        {
        	$studresult->gpa = 4.00;
        	$studresult->grade = 'A+';
        }
        elseif ($studresult->total >= 75)
        {
        	$studresult->gpa = 3.75;
        	$studresult->grade = 'A';
        }
        elseif ($studresult->total >= 70)
        {
        	$studresult->gpa = 3.50;
        	$studresult->grade = 'A-';
        }
        elseif ($studresult->total >= 65)
        {
        	$studresult->gpa = 3.25;
        	$studresult->grade = 'B+';
        }
        elseif ($studresult->total >= 60)
        {
        	$studresult->gpa = 3.00;
        	$studresult->grade = 'B';
        }
        elseif ($studresult->total >= 55)
        {
        	$studresult->gpa = 2.75;
        	$studresult->grade = 'B-';
        }
        elseif ($studresult->total >= 50)
        {
        	$studresult->gpa = 2.50;
        	$studresult->grade = 'C+';
        }
        elseif ($studresult->total >= 45)
        {
        	$studresult->gpa = 2.25;
        	$studresult->grade = 'C';
        }
        elseif ($studresult->total >= 40)
        {
        	$studresult->gpa = 2.00;
        	$studresult->grade = 'D';
        }
        else
        {
        	$studresult->gpa = 0.00;
        	$studresult->grade = 'F';
        }

        $studresult->update();

        return view('crud.response', ['name'=>'studresult', 'msg'=>'Result Updated Successfully', 'viewData'=>$request->viewData]);
    }
}
