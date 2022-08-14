<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Course;
use App\Section;
use App\Semester;
use App\Faculty;
use App\CourseReg;
use App\Department;
use App\DepartmentalCourse;

class RemoteController extends Controller
{
    public $valid = true;
    public $message = '';

    public function __construct() {
        $this->middleware('UserAuth');
    }

    public function __invoke(Request $request)
    {
        function unique($input, $id, $select, $find, $type, $attr, $coustomAttr){
            $allData = $select;
            //dd($allData->all());
            if ($id==='null') {
                foreach ($allData as $data) {
                    if (strtolower($data->$attr)===strtolower($input))
                    {
                        return "The ".$type." ".$coustomAttr." has already been taken";
                    }
                }
                return;
            }
            else
            {
                $ignore = $find;
                foreach ($allData as $data) {
                    if (strtolower($data->$attr)===strtolower($input))
                    {
                        if ($data->$attr===$ignore->$attr)
                        {
                            return;
                        }
                        return "The ".$type." ".$coustomAttr." has already been taken";
                    }
                }
                return;
            }
        }

        function Stud_FM_id_verify($user_id){
            $user = User::where('user_id', $user_id)->first();

            if (!isset($user))
            {
                return "This user id not associated with any student or faculty member";
            }

            if ($user->type === "Student" || $user->type === "Faculty Member") {
                return;
            }
            else
            {
                return "This user id not associated with any student or faculty member";
            }

        }

        function Stud_verify($user_id){
            $user = User::where('user_id', $user_id)->first();

            if (!isset($user))
            {
                return "This user id not associated with any student";
            }

            if ($user->type === "Student")
            {
                return;
            }
            else
            {
                return "This user id not associated with any student";
            }

        }

        function pass_check($id, $password){
            $pass = md5($password);
            $user = User::where('id', $id)->where('password', $pass)->select('password')->first();
            if (!isset($user))
            {
                return 'You entered wrong password';
            }
            return;

        }

        if (isset($request->code) && $request->type==='Course')
        {
            $result = unique($request->code, $request->id, Course::all(), Course::find($request->id), strtolower($request->type), 'code', 'code');
            if (!empty($result))
            {
                $this->valid = false;
                $this->message = $result;
            }
        }
        else if (isset($request->title) && $request->type==='Course')
        {
            $result = unique($request->title, $request->id, Course::all(), Course::find($request->id), strtolower($request->type), 'title', 'title');
            if (!empty($result))
            {
                $this->valid = false;
                $this->message = $result;
            }
        }
        else if (isset($request->name) && $request->type==='Section')
        {
            $result = unique($request->name, $request->id, Section::all(), Section::find($request->id), strtolower($request->type), 'name', 'name');
            if (!empty($result))
            {
                $this->valid = false;
                $this->message = $result;
            }
        }

        else if (isset($request->name) && $request->type==='Semester')
        {
            $result = unique($request->name, $request->id, Semester::all(), Semester::find($request->id), strtolower($request->type), 'name', 'name');
            if (!empty($result))
            {
                $this->valid = false;
                $this->message = $result;
            }
        }
        else if (isset($request->name) && $request->type==='Faculty')
        {
            $result = unique($request->name, $request->id, Faculty::all(), Faculty::find($request->id), strtolower($request->type), 'name', 'name');
            if (!empty($result))
            {
                $this->valid = false;
                $this->message = $result;
            }
        }
        else if (isset($request->code) && $request->type==='Faculty')
        {
            $result = unique($request->code, $request->id, Faculty::all(), Faculty::find($request->id), strtolower($request->type), 'code', 'code');
            if (!empty($result))
            {
                $this->valid = false;
                $this->message = $result;
            }
        }
        else if (isset($request->abbreviation) && $request->type==='Faculty')
        {
            $result = unique($request->abbreviation, $request->id, Faculty::all(), Faculty::find($request->id), strtolower($request->type), 'abbreviation', 'abbreviation');
            if (!empty($result))
            {
                $this->valid = false;
                $this->message = $result;
            }
        }
        else if (isset($request->name) && $request->type==='Department')
        {
            $result = unique($request->name, $request->id, Department::all(), Department::find($request->id), strtolower($request->type), 'name', 'name');
            if (!empty($result))
            {
                $this->valid = false;
                $this->message = $result;
            }
        }
        else if (isset($request->code) && $request->type==='Department')
        {
            $result = unique($request->code, $request->id, Department::all(), Department::find($request->id), strtolower($request->type), 'code', 'code');
            if (!empty($result))
            {
                $this->valid = false;
                $this->message = $result;
            }
        }
        else if (isset($request->abbreviation) && $request->type==='Department')
        {
            $result = unique($request->abbreviation, $request->id, Department::all(), Department::find($request->id), strtolower($request->type), 'abbreviation', 'abbreviation');
            if (!empty($result))
            {
                $this->valid = false;
                $this->message = $result;
            }
        }
        else if (isset($request->dept_code) && $request->type==='DepartmentalCourse')
        {

            $result = unique($request->dept_code, $request->id, DepartmentalCourse::all(), DepartmentalCourse::find($request->id), 'department', 'dept_code', 'name');
            if (!empty($result))
            {
                $this->valid = false;
                $this->message = $result;
            }

        }
        else if (isset($request->email) && $request->type==='UserReg')
        {
            $result = unique($request->email, $request->id, User::all(), User::find($request->id), 'user', 'email', 'email');
            if (!empty($result))
            {
                $this->valid = false;
                $this->message = $result;
            }
        }
        else if (isset($request->phone) && $request->type==='UserReg')
        {
            $result = unique($request->phone, $request->id, User::all(), User::find($request->id), 'user', 'phone', 'phone');
            if (!empty($result))
            {
                $this->valid = false;
                $this->message = $result;
            }
        }
        else if (isset($request->sem_code) && $request->type==='CourseReg')
        {
            if (isset($request->user_id)) {
                $user = User::where('user_id', $request->user_id)->select('type')->first();
                if ($user->type === 'Student')
                {
                    $result = unique($request->sem_code, $request->id, CourseReg::where('user_id', $request->user_id)->get(), CourseReg::find($request->id), 'semester', 'sem_code', 'name');
                    if (!empty($result))
                    {
                        $this->valid = false;
                        $this->message = $result;
                    }
                }
            }
            else
            {
                $this->valid = false;
                $this->message = 'Somethig went wrong please contact with admin';
            }
        }

        else if (isset($request->user_id) && $request->type==='CourseReg')
        {
            $result = Stud_FM_id_verify($request->user_id);
            if (!empty($result))
            {
                $this->valid = false;
                $this->message = $result;
            }
        }

        else if (isset($request->user_id) && $request->type==='TutionFee')
        {
            $result = Stud_verify($request->user_id);
            if (!empty($result))
            {
                $this->valid = false;
                $this->message = $result;
            }
        }

        else if (isset($request->user_id) && $request->type==='Result')
        {
            $result = Stud_verify($request->user_id);
            if (!empty($result))
            {
                $this->valid = false;
                $this->message = $result;
            }
        }

        else if (isset($request->old_password) && $request->type==='PassChange')
        {
            $result = pass_check($request->id, $request->old_password);
            if (!empty($result))
            {
                $this->valid = false;
                $this->message = $result;
            }
        }

        return json_encode($this->valid ? array('valid' => $this->valid) : array('valid' => $this->valid, 'message' => $this->message));
    }
}
