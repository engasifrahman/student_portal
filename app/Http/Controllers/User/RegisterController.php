<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Semester;
use App\Faculty;
use App\Department;
use App\User;

class RegisterController extends Controller
{

    public function __construct() {
        $this->middleware('SAAuth');
    }

    public function index()
    {
        $semesters = Semester::orderBy('id', 'DESC')->get();
        $faculties = Faculty::all();
        $departments = Department::all();
        return view('userreg.index', compact('semesters', 'faculties'));
    }

    public function dynamic(Request $request)
    {
        if (isset($request->faculty_code)) {
            $faculty_code = implode(', ', $request->faculty_code);
            $data = ['faculty_codes'=>$faculty_code];
            $request->merge($data);

            $this->validate($request,[
                'faculty_codes'=>'required',
            ]);
             $departments = Department::whereIn('faculty_code', $request->faculty_code)->get();
             return compact('departments');
        }
        else
        {
            return response()->json(['message'=>'invalid']);;
        }

    }

    public function view()
    {

        $users = User::orderBy('id', 'DESC')->get();
        foreach ($users as $key => $user)
        {
            $dept_codes = explode(', ', $user->dept_code);
            //print_r($dept_codes);
            $dept_abbreviation = Department::whereIn('code', $dept_codes)->select('abbreviation')->get();
            $abbreviation = '';
            foreach ($dept_abbreviation as $key => $dept) {
                if ($key == 0) {
                    $abbreviation = $dept->abbreviation;
                }
                else
                {
                    $abbreviation .= ', '.$dept->abbreviation;
                }
            }
            //echo $abbreviation.'<br>';
            $user->department = $abbreviation;
            //echo "<pre>";
            //print_r($users[$key]);
            //echo "</pre>";
        }
        //echo "<pre>";
        //print_r($users);
        //echo "</pre>";
        $data = $users;
        return view('userreg.view', compact('data'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        if (isset($request->faculty_code)) {
            $totalFaculty = sizeof($request->faculty_code);
            if ($request->type === 'Student')
            {
                if ($totalFaculty > 1)
                {
                    return response()->json(['message'=>'The given data was invalid.', 'errors'=> ['faculty_code'=>'Student can registered under only one faculty']], 422);
                }
                elseif (!empty($request->abbreviation)) {
                    return response()->json(['message'=>'The given data was invalid.', 'errors'=> ['abbreviation'=>'Abbreviation is not available for student']], 422);
                }
                elseif (!empty($request->designation)) {
                    return response()->json(['message'=>'The given data was invalid.', 'errors'=> ['designation'=>'Designation is not available for student']], 422);
                }
            }
            elseif($request->type !== 'Student')
            {
                if(empty($request->designation))
                {
                    return response()->json(['message'=>'The given data was invalid.', 'errors'=> ['designation'=>'The designation is required and can not be empty']], 422);
                }
                elseif ($request->type === 'Faculty Member' && empty($request->abbreviation)) {
                    return response()->json(['message'=>'The given data was invalid.', 'errors'=> ['abbreviation'=>'The abbreviation is required and can not be empty']], 422);
                }
                elseif ($request->type !== 'Faculty Member' && !empty($request->abbreviation)) {
                    return response()->json(['message'=>'The given data was invalid.', 'errors'=> ['abbreviation'=>'Abbreviation is not available for '.strtolower($request->type)]], 422);
                }
            }

            $faculty_code = implode(', ', $request->faculty_code);
            $data = ['faculty_codes'=>$faculty_code];
            $request->merge($data);
        }
        else
        {
            return response()->json(['message'=>'The given data was invalid.', 'errors'=> ['faculty_code'=>'The faculty name is required and can not be empty']], 422);
        }

        if (isset($request->dept_code)) {

            $totalDept = sizeof($request->dept_code);
            if ($request->type === 'Student' && $totalDept > 1)
            {
                return response()->json(['message'=>'The given data was invalid.', 'errors'=> ['dept_code'=>'Student can registered under only one department']], 422);
            }

            $dept_code = implode(', ', $request->dept_code);
            $data = ['dept_codes'=>$dept_code];
            $request->merge($data);
        }
        else
        {
            return response()->json(['message'=>'The given data was invalid.', 'errors'=> ['dept_code'=>'The department name is required and can not be empty']], 422);
        }

        $this->validate($request,[
            'type'              =>'required|max:20',
            'sem_code'          =>'required|max:993|numeric',
            'faculty_codes'     =>'required',
            'dept_codes'        =>'required',
            'userreg_picture'   =>'nullable|mimes:jpeg,png,jpg,gif|max:2048',
            'name'              =>'required|max:100',
            'abbreviation'      =>'nullable|max:10|alpha',
            'designation'       =>'nullable|max:100',
            'dob'               =>'required|date',
            'gender'            =>'required|max:10',
            'marital_status'    =>'required|max:15',
            'nationality'       =>'required|max:20',
            'nid'               =>'nullable|min:9|max:20',
            'birth_certificate' =>'nullable|min:9|max:20',
            'father_name'       =>'required|max:100',
            'mother_name'       =>'required|max:100',
            'email'             =>'required|max:100|email|unique:users,email',
            'altr_email'        =>'nullable|max:100|email',
            'phone'             =>'required|numeric|unique:users,phone',
            'altr_phone'        =>'nullable|numeric',
            'permanent_addr'    =>'required|max:250',
            'present_addr'      =>'required|max:250',
        ]);

        if ($request->type === 'Student')
        {
            $user = User::where('sem_code', $request->sem_code)->where('dept_code', $request->dept_codes)->where('type', 'Student')->select('user_id')->orderBy('user_id', 'DESC')->first();

            if (isset($user)) {
                $user_id = $user->user_id;
                $user_id++;
                $password = md5($user_id);
            }
            else
            {
                $user_id = $request->sem_code.'-'.$request->dept_codes.'-0001';
                $password = md5($user_id);
            }
        }
        else
        {
            $user = User::where('type', '<>', 'Student')->select('user_id')->orderBy('user_id', 'DESC')->first();
            if (isset($user))
            {
                $user_id = $user->user_id;
                $user_id++;
                $password = md5($user_id);
            }
            else
            {
                $user_id = '71000001';
                $password = md5($user_id);
            }
        }

        if($pictureInfo = $request->file('userreg_picture')){
            $pictureName = $request->email.$pictureInfo->getClientOriginalName();
            $folder = 'usersPic/';
            $pictureInfo->move($folder, $pictureName);
            $pic_dir = $folder.$pictureName;
        }
        else if ($request->gender==='Male') {
            $pic_dir = 'usersPic/male.png';
        }
        else if ($request->gender==='Female') {
            $pic_dir = 'usersPic/female.png';
        }
        else if ($request->gender==='Others') {
            $pic_dir = 'usersPic/others.png';
        }

        $userreg = new User;
        $userreg->user_id           = $user_id;
        $userreg->type              = $request->type;
        $userreg->sem_code          = $request->sem_code;
        $userreg->faculty_code      = $request->faculty_codes;
        $userreg->dept_code         = $request->dept_codes;
        $userreg->pic_dir           = $pic_dir;
        $userreg->name              = $request->name;
        $userreg->abbreviation      = $request->abbreviation;
        $userreg->designation       = $request->designation;
        $userreg->dob               = $request->dob;
        $userreg->gender            = $request->gender;
        $userreg->marital_status    = $request->marital_status;
        $userreg->nationality       = $request->nationality;
        $userreg->nid               = $request->nid;
        $userreg->birth_certificate = $request->birth_certificate;
        $userreg->father_name       = $request->father_name;
        $userreg->mother_name       = $request->mother_name;
        $userreg->email             = $request->email;
        $userreg->altr_email        = $request->altr_email;
        $userreg->phone             = $request->phone;
        $userreg->altr_phone        = $request->altr_phone;
        $userreg->permanent_addr    = $request->permanent_addr;
        $userreg->present_addr      = $request->present_addr;
        $userreg->password          = $password;
        $userreg->save();

        return view('crud.response', ['name'=>'userreg', 'msg'=>'Stored Successfully']);

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $editData = User::find($id);
        return compact('editData');
    }

    public function update(Request $request, $id)
    {

        if (isset($request->faculty_code)) {
            $totalFaculty = sizeof($request->faculty_code);
            if ($request->type === 'Student')
            {
                if ($totalFaculty > 1)
                {
                    return response()->json(['message'=>'The given data was invalid.', 'errors'=> ['faculty_code'=>'Student can registered under only one faculty']], 422);
                }
                elseif (!empty($request->abbreviation)) {
                    return response()->json(['message'=>'The given data was invalid.', 'errors'=> ['abbreviation'=>'Abbreviation is not available for student']], 422);
                }
                elseif (!empty($request->designation)) {
                    return response()->json(['message'=>'The given data was invalid.', 'errors'=> ['designation'=>'Designation is not available for student']], 422);
                }
            }
            elseif($request->type !== 'Student')
            {
                if(empty($request->designation))
                {
                    return response()->json(['message'=>'The given data was invalid.', 'errors'=> ['designation'=>'The designation is required and can not be empty']], 422);
                }
                elseif ($request->type === 'Faculty Member' && empty($request->abbreviation)) {
                    return response()->json(['message'=>'The given data was invalid.', 'errors'=> ['abbreviation'=>'The abbreviation is required and can not be empty']], 422);
                }
                elseif ($request->type !== 'Faculty Member' && !empty($request->abbreviation)) {
                    return response()->json(['message'=>'The given data was invalid.', 'errors'=> ['abbreviation'=>'Abbreviation is not available for '.strtolower($request->type)]], 422);
                }
            }

            $faculty_code = implode(', ', $request->faculty_code);
            $data = ['faculty_codes'=>$faculty_code];
            $request->merge($data);
        }
        else
        {
            return response()->json(['message'=>'The given data was invalid.', 'errors'=> ['faculty_code'=>'The faculty name is required and can not be empty']], 422);
        }

        if (isset($request->dept_code)) {

            $totalDept = sizeof($request->dept_code);
            if ($request->type === 'Student' && $totalDept > 1)
            {
                return response()->json(['message'=>'The given data was invalid.', 'errors'=> ['dept_code'=>'Student can registered under only one department']], 422);
            }

            $dept_code = implode(', ', $request->dept_code);
            $data = ['dept_codes'=>$dept_code];
            $request->merge($data);
        }
        else
        {
            return response()->json(['message'=>'The given data was invalid.', 'errors'=> ['dept_code'=>'The department name is required and can not be empty']], 422);
        }

        $this->validate($request,[
            'type'              =>'required|max:20',
            'sem_code'          =>'required|max:993|numeric',
            'faculty_codes'     =>'required',
            'dept_codes'        =>'required',
            'userreg_picture'   =>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name'              =>'required|max:100',
            'abbreviation'      =>'nullable|max:10|alpha',
            'designation'       =>'nullable|max:100',
            'dob'               =>'required|date',
            'gender'            =>'required|max:10',
            'marital_status'    =>'required|max:15',
            'nationality'       =>'required|max:20',
            'nid'               =>'nullable|min:9|max:20',
            'birth_certificate' =>'nullable|min:9|max:20',
            'father_name'       =>'required|max:100',
            'mother_name'       =>'required|max:100',
            'email'             =>'required|max:100|email|unique:users,email,'.$id,
            'altr_email'        =>'nullable|max:100|email',
            'phone'             =>'required|numeric|unique:users,phone,'.$id,
            'altr_phone'        =>'nullable|numeric',
            'permanent_addr'    =>'required|max:250',
            'present_addr'      =>'required|max:250',
        ]);

        $userreg = User::find($id);

        if ($request->type === $userreg->type)
        {
            if ($request->type === 'Student')
            {
                if ($request->sem_code !== $userreg->sem_code || $request->dept_codes !== $userreg->dept_code)
                {
                    $user = User::where('sem_code', $request->sem_code)->where('dept_code', $request->dept_codes)->where('type', 'Student')->select('user_id')->orderBy('user_id', 'DESC')->first();

                    if (isset($user))
                    {
                        $user_id = $user->user_id;
                        $user_id++;
                        $password = md5($user_id);
                    }
                    else
                    {
                        $user_id = $request->sem_code.'-'.$request->dept_codes.'-0001';
                        $password = md5($user_id);
                    }
                }
                else
                {
                    $user_id    = $userreg->user_id;
                    $password   = $userreg->password;
                }
            }
            else
            {
                $user_id    = $userreg->user_id;
                $password   = $userreg->password;
            }
        }
        else
        {
            if ($request->type === 'Student')
            {
                $user = User::where('sem_code', $request->sem_code)->where('dept_code', $request->dept_codes)->where('type', 'Student')->select('user_id')->orderBy('user_id', 'DESC')->first();

                if (isset($user)) {
                    $user_id = $user->user_id;
                    $user_id++;
                    $password = md5($user_id);
                }
                else
                {
                    $user_id = $request->sem_code.'-'.$request->dept_codes.'-0001';
                    $password = md5($user_id);
                }
            }
            elseif($userreg->type === 'Student')
            {
                $user = User::where('type', '<>', 'Student')->select('user_id')->orderBy('user_id', 'DESC')->first();
                $user_id = $user->user_id;
                $user_id++;
                $password = md5($user_id);
            }
            else
            {
                $user_id    = $userreg->user_id;
                $password   = $userreg->password;
            }
        }

        if ($request->userreg_changePic)
        {
            if ($pictureInfo = $request->file('userreg_picture'))
            {
                if (file_exists($userreg->pic_dir) && $userreg->pic_dir!=='usersPic/male.png' && $userreg->pic_dir!=='usersPic/female.png' && $userreg->pic_dir!=='usersPic/others.png')
                {
                    unlink($userreg->pic_dir);
                }

                $pictureName = $request->email.$pictureInfo->getClientOriginalName();
                $folder = 'usersPic/';
                $pictureInfo->move($folder, $pictureName);
                $pic_dir = $folder.$pictureName;
            }
            else if (file_exists($userreg->pic_dir) && $userreg->pic_dir!=='usersPic/male.png' && $userreg->pic_dir!=='usersPic/female.png' && $userreg->pic_dir!=='usersPic/others.png')
            {
                unlink($userreg->pic_dir);
                if ($request->gender==='Male') {
                    $pic_dir = 'usersPic/male.png';
                }
                else if ($request->gender==='Female') {
                    $pic_dir = 'usersPic/female.png';
                }
                else if ($request->gender==='Others') {
                    $pic_dir = 'usersPic/others.png';
                }
            }
            else
            {
                if ($request->gender==='Male')
                {
                    $pic_dir = 'usersPic/male.png';
                }
                else if ($request->gender==='Female')
                {
                    $pic_dir = 'usersPic/female.png';
                }
                else if ($request->gender==='Others')
                {
                    $pic_dir = 'usersPic/others.png';
                }
            }
        }
        elseif (file_exists($userreg->pic_dir) && $userreg->pic_dir !== 'usersPic/male.png' && $userreg->pic_dir !== 'usersPic/female.png' && $userreg->pic_dir !== 'usersPic/others.png')
        {
            $pic_dir = $userreg->pic_dir;
        }
        elseif (file_exists($userreg->pic_dir) && $userreg->pic_dir === 'usersPic/male.png' && $userreg->pic_dir === 'usersPic/female.png' && $userreg->pic_dir === 'usersPic/others.png')
        {
            if ($request->gender==='Male')
            {
                $pic_dir = 'usersPic/male.png';
            }
            else if ($request->gender==='Female')
            {
                $pic_dir = 'usersPic/female.png';
            }
            else if ($request->gender==='Others')
            {
                $pic_dir = 'usersPic/others.png';
            }
        }
        else
        {
            if ($request->gender==='Male')
            {
                $pic_dir = 'usersPic/male.png';
            }
            else if ($request->gender==='Female')
            {
                $pic_dir = 'usersPic/female.png';
            }
            else if ($request->gender==='Others')
            {
                $pic_dir = 'usersPic/others.png';
            }
        }

        $userreg->user_id           = $user_id;
        $userreg->type              = $request->type;
        $userreg->sem_code          = $request->sem_code;
        $userreg->faculty_code      = $request->faculty_codes;
        $userreg->dept_code         = $request->dept_codes;
        $userreg->pic_dir           = $pic_dir;
        $userreg->name              = $request->name;
        $userreg->abbreviation      = $request->abbreviation;
        $userreg->designation       = $request->designation;
        $userreg->dob               = $request->dob;
        $userreg->gender            = $request->gender;
        $userreg->marital_status    = $request->marital_status;
        $userreg->nationality       = $request->nationality;
        $userreg->nid               = $request->nid;
        $userreg->birth_certificate = $request->birth_certificate;
        $userreg->father_name       = $request->father_name;
        $userreg->mother_name       = $request->mother_name;
        $userreg->email             = $request->email;
        $userreg->altr_email        = $request->altr_email;
        $userreg->phone             = $request->phone;
        $userreg->altr_phone        = $request->altr_phone;
        $userreg->permanent_addr    = $request->permanent_addr;
        $userreg->present_addr      = $request->present_addr;
        $userreg->password          = $password;
        $userreg->update();

        return view('crud.response', ['name'=>'userreg', 'msg'=>'Updated Successfully']);
    }

    public function destroy($id)
    {
        $userreg = User::find($id);
        if (file_exists($userreg->pic_dir) && $userreg->pic_dir!=='usersPic/male.png' && $userreg->pic_dir!=='usersPic/female.png' && $userreg->pic_dir!=='usersPic/others.png')
        {
            unlink($userreg->pic_dir);
        }

       $userreg->delete();
       return view('crud.response', ['name'=>'userreg', 'msg'=>'Deleted Successfully']);
    }
}
