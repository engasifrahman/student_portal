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
class CourseRegController extends Controller
{
    public function __construct() {
        $this->middleware('SAAuth');
    }

    public function index()
    {
        return view('coursereg.index');
    }

    public function search(Request $request )
    {
        $user = User::join('semesters', 'sem_code', 'code')->where('user_id', $request->user_id)->select('users.*', 'semesters.name AS semester')->first();

        $faculty_codes = explode(', ', $user->faculty_code);
        $faculty_abbreviation = Faculty::whereIn('code', $faculty_codes)->select('abbreviation')->get();
        $abbreviation = '';
        foreach ($faculty_abbreviation as $key => $faculty)
        {
            if ($key == 0) {
                $abbreviation = $faculty->abbreviation;
            }
            else
            {
                $abbreviation .= ', '.$faculty->abbreviation;
            }
        }
        $user->faculty = $abbreviation;

        $dept_codes = explode(', ', $user->dept_code);
        $dept_abbreviation = Department::whereIn('code', $dept_codes)->select('abbreviation')->get();
        $abbreviation = '';
        foreach ($dept_abbreviation as $key => $dept)
        {
            if ($key == 0) {
                $abbreviation = $dept->abbreviation;
            }
            else
            {
                $abbreviation .= ', '.$dept->abbreviation;
            }
        }
        $user->department = $abbreviation;

        if (!isset($user))
        {
            return response()->json(['message'=>'The given data was invalid.', 'errors'=> ['user_id'=>'This user id not associated with any student or faculty member']], 422);
        }

        if ($user->type === "Student" || $user->type === "Faculty Member") {
            $sections = Section::all();
            $semesters = Semester::orderBy('id', 'DESC')->get();
            $dept_codes = explode(', ', $user->dept_code);
            $deptCourses = DepartmentalCourse::whereIn('dept_code', $dept_codes)->first();

            if (!isset($deptCourses))
            {
                return response()->json(['message'=>'No courses have been founded under the selected user\'s department\'s.'], 420);
            }
            else
            {
                $departments = Department::whereIn('code', $dept_codes)->get();
                return view('coursereg.result', compact('user', 'semesters', 'sections', 'departments'));
            }
        }
        else
        {
            return response()->json(['message'=>'The given data was invalid.', 'errors'=> ['user_id'=>'This user id not associated with any student or faculty member']], 422);
        }
    }

    public function dynamic(Request $request)
    {
        if (isset($request->department_code)) {
            $departments = DepartmentalCourse::where('dept_code', $request->department_code)->first();
            $course_codes = explode(', ', $departments->course_code);
            $courses = Course::whereIn('code', $course_codes)->select('courses.code', 'courses.title')->get();
            return compact('courses');
        }
        else
        {
            return response()->json(['message'=>'invalid']);;
        }

    }

    public function view(Request $request)
    {
        $data = CourseReg::join('users', 'users.user_id', 'course_regs.user_id')->join('semesters', 'code', 'course_regs.sem_code')->where('course_regs.user_id', $request->user_id)->select('course_regs.*', 'users.name', 'semesters.name AS semester')->orderBy('course_regs.id', 'DESC')->get();

            return view('coursereg.view', compact('data'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $user = User::where('user_id', $request->user_id)->select('type')->first();

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
            'user_id'=>'required|max:12',
            'department_code'=>'required|max:10',
            'sem_code'=>'required|max:3',
            'section'=>'required|alpha|max:1',
            'course_codes'=>'required|max:1000',
        ]);

        if ($user->type === "Faculty Member")
        {
            foreach ($request->course_code as $course_code)
            {
                $course_regs = CourseReg::where('dept_code', $request->department_code)->where('sem_code', $request->sem_code)->where('section', $request->section)->select('user_id', 'course_code')->get();
                foreach ($course_regs as $course_reg)
                {
                    $selectedUser = User::where('user_id', $course_reg->user_id)->select('type')->first();
                    if ($selectedUser->type === 'Faculty Member')
                    {
                        $selectedCourses = explode(', ', $course_reg->course_code);
                        foreach ($selectedCourses as $selectedCourse)
                        {
                            if ($course_code === $selectedCourse)
                            {
                               return response()->json(['message'=>'Selected '.$course_code.' course alraedy registred for '.$course_reg->user_id.' faculty member.'], 420);
                            }
                        }
                    }
                }

            }
        }
        elseif ($user->type === "Student") {
            foreach ($request->course_code as $key => $course_code) {
                $result = new StudResult;
                $result->stud_id     = $request->user_id;
                $result->dept_code   = $request->department_code;
                $result->sem_code    = $request->sem_code;
                $result->section     = $request->section;
                $result->course_code = $course_code;
                $result->save();
            }

            $courses = Course::whereIn('code', $request->course_code)->get();
            $total_fee = 0;
            foreach ($courses as $key => $course) {
                $total_fee +=  $course->cost * $course->credit;
            }

            $tutionFee = new TutionFee;
            $tutionFee->stud_id     = $request->user_id;
            $tutionFee->dept_code   = $request->department_code;
            $tutionFee->sem_code    = $request->sem_code;
            $tutionFee->section     = $request->section;
            $tutionFee->course_code = $request->course_codes;
            $tutionFee->total_fee   = $total_fee;
            $tutionFee->paid        = 0;
            $tutionFee->due         = $total_fee;
            $tutionFee->save();
        }

        $coursereg = new CourseReg;
        $coursereg->user_id     = $request->user_id;
        $coursereg->dept_code   = $request->department_code;
        $coursereg->sem_code    = $request->sem_code;
        $coursereg->section     = $request->section;
        $coursereg->course_code = $request->course_codes;
        $coursereg->save();

        return view('crud.response', ['name'=>'coursereg', 'msg'=>'Stored Successfully', 'user_id'=>$request->user_id]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $editData = CourseReg::find($id);
        return compact('editData');
    }

    public function update(Request $request, $id)
    {
        $user = User::where('user_id', $request->user_id)->select('type')->first();

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
            'user_id'=>'required|max:12',
            'department_code'=>'required|max:10',
            'sem_code'=>'required|max:3',
            'section'=>'required|alpha|max:1',
            'course_codes'=>'required|max:1000',
        ]);

        $coursereg = CourseReg::find($id);

        if ($user->type === "Faculty Member")
        {
            foreach ($request->course_code as $course_code)
            {
                $course_regs = CourseReg::where('dept_code', $request->department_code)->where('sem_code', $request->sem_code)->where('section', $request->section)->get();
                foreach ($course_regs as $course_reg)
                {
                    if ($coursereg->user_id === $course_reg->user_id && $coursereg->dept_code === $course_reg->dept_code && $coursereg->sem_code === $course_reg->sem_code && $coursereg->section === $course_reg->section)
                    {
                        $selectedCourses = explode(', ', $course_reg->course_code);
                        foreach ($selectedCourses as $selectedCourse)
                        {
                            if ($course_code === $selectedCourse)
                            {
                                $ignoreCourses = explode(', ', $coursereg->course_code);
                                foreach ($ignoreCourses as $ignoreCourse)
                                {
                                    if ($course_code !== $ignoreCourse)
                                    {
                                     return response()->json(['message'=>'Selected '.$course_code.' course alraedy registred for this faculty member.'], 420);
                                    }
                                }
                            }
                        }

                    }
                    else
                    {
                        $selectedUser = User::where('user_id', $course_reg->user_id)->select('type')->first();
                        if ($selectedUser->type === 'Faculty Member')
                        {
                            $selectedCourses = explode(', ', $course_reg->course_code);
                            foreach ($selectedCourses as $selectedCourse)
                            {
                                if ($course_code === $selectedCourse)
                                {
                                    return response()->json(['message'=>'Selected '.$course_code.' course alraedy registred for '.$course_reg->user_id.' faculty member.'], 420);
                                }
                            }
                        }
                    }
               }
           }
        }
        elseif ($user->type === "Student")
        {
            $old_course_code = explode(', ', $coursereg->course_code);

            $old_length = sizeof($old_course_code);
            $new_length = sizeof($request->course_code);

            if ($old_length > $new_length)
            {
                for($i = $old_length-1; $i >= $new_length; $i--)
                {
                    $deleteResult = StudResult::where('stud_id', $coursereg->user_id)->where('dept_code', $coursereg->dept_code)->where('sem_code', $coursereg->sem_code)->where('section', $coursereg->section)->where('course_code',  $old_course_code[$i])->delete();
                }

                foreach ($request->course_code as $key => $course_code)
                {
                    $result = StudResult::where('stud_id', $coursereg->user_id)->where('dept_code', $coursereg->dept_code)->where('sem_code', $coursereg->sem_code)->where('section', $coursereg->section)->where('course_code', $old_course_code[$key])->first();
                    $result->stud_id     = $request->user_id;
                    $result->dept_code   = $request->department_code;
                    $result->sem_code    = $request->sem_code;
                    $result->section     = $request->section;
                    $result->course_code = $course_code;
                    $result->update();
                }
            }
            else
            {
                foreach ($request->course_code as $key => $course_code)
                {
                    if ($old_length <= $new_length && $old_length > $key)
                    {
                        $result = StudResult::where('stud_id', $coursereg->user_id)->where('dept_code', $coursereg->dept_code)->where('sem_code', $coursereg->sem_code)->where('section', $coursereg->section)->where('course_code', $old_course_code[$key])->first();
                        $result->stud_id     = $request->user_id;
                        $result->dept_code   = $request->department_code;
                        $result->sem_code    = $request->sem_code;
                        $result->section     = $request->section;
                        $result->course_code = $course_code;
                        $result->update();
                    }
                    else
                    {
                        $result = new StudResult;
                        $result->stud_id     = $request->user_id;
                        $result->dept_code   = $request->department_code;
                        $result->sem_code    = $request->sem_code;
                        $result->section     = $request->section;
                        $result->course_code = $course_code;
                        $result->save();
                    }
                }
            }

            $courses = Course::whereIn('code', $request->course_code)->get();
            $total_fee = 0;
            foreach ($courses as $key => $course) {
                $total_fee +=  $course->cost * $course->credit;
            }
            $tutionFee = TutionFee::where('stud_id', $coursereg->user_id)->where('dept_code', $coursereg->dept_code)->where('sem_code', $coursereg->sem_code)->where('section', $coursereg->section)->first();
            $tutionFee->stud_id     = $request->user_id;
            $tutionFee->dept_code   = $request->department_code;
            $tutionFee->sem_code    = $request->sem_code;
            $tutionFee->section     = $request->section;
            $tutionFee->course_code = $request->course_codes;
            $tutionFee->total_fee   = $total_fee;
            $tutionFee->paid        = 0;
            $tutionFee->due         = $total_fee;
            $tutionFee->update();
        }

        $coursereg->user_id     = $request->user_id;
        $coursereg->dept_code   = $request->department_code;
        $coursereg->sem_code    = $request->sem_code;
        $coursereg->section     = $request->section;
        $coursereg->course_code = $request->course_codes;
        $coursereg->update();

        return view('crud.response', ['name'=>'coursereg', 'msg'=>'Updated Successfully', 'user_id'=>$request->user_id]);
    }

    public function destroy($id)
    {
        $coursereg = CourseReg::find($id);
        $user = User::where('user_id', $coursereg->user_id)->select('type')->first();
        $user_id = $coursereg->user_id;

        if ($user->type === "Student")
        {
            $course_code = explode(', ', $coursereg->course_code);

            $length = sizeof($course_code);

            for($i = 0; $i < $length; $i++)
            {
                $deleteResult = StudResult::where('stud_id', $coursereg->user_id)->where('dept_code', $coursereg->dept_code)->where('sem_code', $coursereg->sem_code)->where('section', $coursereg->section)->where('course_code',  $course_code[$i])->delete();
            }

            $deleteTutionFee = TutionFee::where('stud_id', $coursereg->user_id)->where('dept_code', $coursereg->dept_code)->where('sem_code', $coursereg->sem_code)->where('section', $coursereg->section)->where('course_code',  $coursereg->course_code)->delete();
        }

        $deleteCoursereg = CourseReg::find($id)->delete();

        return view('crud.response', ['name'=>'coursereg', 'msg'=>'Deleted Successfully', 'user_id'=>$user_id]);
    }
}
