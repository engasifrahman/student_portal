<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Course;
use App\Semester;
use App\StudResult;

class ResultController extends Controller
{
    public function __construct() {
        $this->middleware('StudAuth');
    }

    public function index()
    {
        $semesters = Semester::orderBy('id', 'DESC')->get();
        return view('result.index', compact('semesters'));
    }

    public function result(Request $request )
    {

		$this->validate($request,[
            'user_id'=>'required',
            'sem_code'=>'required',
        ]);

        $publish_status = Semester::where('code', $request->sem_code)->first('published');

        $total_gpa = 0;
        $total_credit = 0;
        $sgpa = 0;

        if (isset($publish_status) && $publish_status->published === 'true')
        {
            $studresult = StudResult::join('courses', 'code', 'stud_results.course_code')->where('stud_id', $request->user_id)->where('sem_code', $request->sem_code)->select('stud_results.gpa', 'stud_results.grade', 'stud_results.course_code', 'courses.title AS course_title', 'courses.credit AS course_credit')->get();

            foreach ($studresult as $key => $data) {
                $total_gpa += $data->gpa * $data->course_credit;
                $total_credit += $data->course_credit;
            }
            if (sizeof($studresult))
            {
                $sgpa = $total_gpa / $total_credit;
            }
            $data = $studresult;
            return view('result.view', compact('data'), ['total_credit'=>$total_credit, 'sgpa'=>$sgpa]);
        }
        else
        {
            $data = [];
            return view('result.view', compact('data'), ['total_credit'=>$total_credit, 'sgpa'=>$sgpa]);
        }
  }

}
