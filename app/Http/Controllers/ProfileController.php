<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Faculty;
use App\Department;

class ProfileController extends Controller
{
    public function __construct() {
        $this->middleware('UserAuth');
    }
    public function index($id)
    {
        if (session()->has('system_admin'))
        {
            $user_id = session()->get('system_admin.user_id');
        }
        elseif (session()->has('finance_admin'))
        {
            $user_id = session()->get('finance_admin.user_id');
        }
        elseif (session()->has('faculty_member'))
        {
            $user_id = session()->get('faculty_member.user_id');
        }
        elseif (session()->has('student'))
        {
            $user_id = session()->get('student.user_id');
        }
        else
        {
            return redirect('/dashboard');
        }

        if ($user_id == $id)
        {
            return view('profile.index');
        }
        else
        {
            return redirect('/dashboard');
        }
    }
    public function view(Request $request)
    {
        $user = User::join('semesters', 'sem_code', 'code')->where('user_id', $request->user_id)->select('users.*', 'semesters.name AS semester')->first();
        // dd($user->toJson(JSON_PRETTY_PRINT));

        if (isset($user))
        {
            $faculty_codes = explode(', ', $user->faculty_code);
            $faculty_abbreviation = Faculty::whereIn('code', $faculty_codes)->select('abbreviation')->get();
            $abbreviation = '';
            foreach ($faculty_abbreviation as $key => $dept)
            {
                if ($key == 0) {
                    $abbreviation = $dept->abbreviation;
                }
                else
                {
                    $abbreviation .= ', '.$dept->abbreviation;
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
        }

        return view('profile.view', compact('user'));
    }

    public function edit($id)
    {
        $editData = User::find($id);
        return compact('editData');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'profile_picture'   =>'nullable|mimes:jpeg,png,jpg,gif|max:2048',
            'nid'               =>'nullable|min:9|max:20',
            'birth_certificate' =>'nullable|min:9|max:20',
            'altr_email'        =>'nullable|max:100|email',
            'altr_phone'        =>'nullable|numeric',
            'permanent_addr'    =>'required|max:250',
            'present_addr'      =>'required|max:250',
        ]);

        $profile = User::find($id);
        $user_id = $profile->user_id;

        if ($request->profile_changePic)
        {
            if ($pictureInfo = $request->file('profile_picture'))
            {
                if (file_exists($profile->pic_dir) && $profile->pic_dir!=='usersPic/male.png' && $profile->pic_dir!=='usersPic/female.png' && $profile->pic_dir!=='usersPic/others.png')
                {
                    unlink($profile->pic_dir);
                }

                $pictureName = $request->email.$pictureInfo->getClientOriginalName();
                $folder = 'usersPic/';
                $pictureInfo->move($folder, $pictureName);
                $pic_dir = $folder.$pictureName;
            }
            else if (file_exists($profile->pic_dir) && $profile->pic_dir!=='usersPic/male.png' && $profile->pic_dir!=='usersPic/female.png' && $profile->pic_dir!=='usersPic/others.png')
            {
                unlink($profile->pic_dir);
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
        elseif (file_exists($profile->pic_dir) && $profile->pic_dir !== 'usersPic/male.png' && $profile->pic_dir !== 'usersPic/female.png' && $profile->pic_dir !== 'usersPic/others.png')
        {
            $pic_dir = $profile->pic_dir;
        }
        elseif (file_exists($profile->pic_dir) && $profile->pic_dir === 'usersPic/male.png' && $profile->pic_dir === 'usersPic/female.png' && $profile->pic_dir === 'usersPic/others.png')
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

        $profile->pic_dir           = $pic_dir;
        $profile->nid               = $request->nid;
        $profile->birth_certificate = $request->birth_certificate;
        $profile->altr_email        = $request->altr_email;
        $profile->altr_phone        = $request->altr_phone;
        $profile->permanent_addr    = $request->permanent_addr;
        $profile->present_addr      = $request->present_addr;
        $profile->update();

        return view('crud.response', ['name'=>'profile', 'msg'=>'Updated Successfully', 'user_id'=>$user_id]);
    }

}
