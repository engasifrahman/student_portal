<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DepartmentalCourse;
use App\Department;
use App\Faculty;
use App\Course;

class DepartmentalCourseController extends Controller
{
    public function __construct() {
        $this->middleware('SAAuth');
    }

    public function index()
    {
        $courses = Course::all();
        $faculties = Faculty::all();
        return view('deptcourse.index', compact('courses', 'faculties'));
    }

    public function dynamic(Request $request)
    {
        if (isset($request->faculty_code)) {
             $this->validate($request,[
                'faculty_code'=>'required|max:10|alpha_num|',
            ]);
             $departments = Department::where('faculty_code', $request->faculty_code)->get();
             return compact('departments');
        }
        else
        {
            return response()->json(['message'=>'invalid']);;
        }

    }

    public function view(Request $request)
    {
        $data = DepartmentalCourse::join('departments', 'departments.code', '=', 'dept_code')->select('departmental_courses.*', 'departments.abbreviation as department')->orderBy('departmental_courses.id', 'DESC')->get();
        return view('deptcourse.view', compact('data'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        if (isset($request->course_code)) {
            $course_codes = implode(', ',  $request->course_code);
            $data = ['course_codes' => $course_codes];
            $request->merge($data);
            //return $request->course_codes;
        }
        else
        {
            return response()->json(['message'=>'The given data was invalid.', 'errors'=> ['course_code'=>'The course name is required and can not be empty']], 422);
        }

        $this->validate($request,[
            'dept_code'=>'required|max:10|alpha_num|unique:departmental_courses,dept_code',
            'course_codes'=>'required|max:1000|unique:departmental_courses,course_code',
        ]);

        $deptcourse = new DepartmentalCourse;
        $deptcourse->dept_code = $request->dept_code;
        $deptcourse->course_code = $request->course_codes;
        $deptcourse->save();
        return view('crud.response', ['name'=>'deptcourse', 'msg'=>'Stored Successfully']);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $editData = DepartmentalCourse::join('departments', 'departments.code', '=', 'dept_code')->select('departmental_courses.*', 'departments.faculty_code as faculty_code')->where('departmental_courses.id', $id)->first();
        return compact('editData');
    }

    public function update(Request $request, $id)
    {
        if (isset($request->course_code)) {
            $course_codes = implode(', ',  $request->course_code);
            $data = ['course_codes' => $course_codes];
            $request->merge($data);
        //return $request->course_codes;
        }
        else
        {
            return response()->json(['message'=>'The given data was invalid.', 'errors'=> ['course_code'=>'The course name is required and can not be empty']], 422);
        }

        $this->validate($request,[
            'dept_code'=>'required|max:10|alpha_num|unique:departmental_courses,dept_code,'.$id,
            'course_codes'=>'required|max:1000|unique:departmental_courses,course_code,'.$id,
        ]);

        $deptcourse = DepartmentalCourse::find($id);
        $deptcourse->dept_code = $request->dept_code;
        $deptcourse->course_code = $request->course_codes;
        $deptcourse->update();

        return view('crud.response', ['name'=>'deptcourse', 'msg'=>'Updated Successfully']);
    }

    public function destroy($id)
    {
       $data = DepartmentalCourse::find($id)->delete();
       return view('crud.response', ['name'=>'deptcourse', 'msg'=>'Deleted Successfully']);
    }
}
