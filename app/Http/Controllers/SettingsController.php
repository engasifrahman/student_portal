<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\USer;

class SettingsController extends Controller
{
    public function __construct() {
        $this->middleware('UserAuth');
    }

    public function view($id)
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
            return view('settings');
        }
        else
        {
            return redirect('/dashboard');
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'old_password'      =>'required|min:6|max:50',
            'new_password'      =>'required|min:6|max:50',
            'confirm_password'  =>'required|min:6|max:50',
        ]);

        $user = User::find($id);

        if ($user->password !== md5($request->old_password))
        {
            return response()->json(['message'=>'The given data was invalid.', 'errors'=> ['old_password'=>'You entered wrong password']], 422);
        }

        if ($request->new_password !== $request->confirm_password)
        {
            return response()->json(['message'=>'The given data was invalid.', 'errors'=> ['confirm_password'=>'The confirm password is not the same as new password']], 422);
        }

        $user->password = md5($request->confirm_password);
        $user->update();

        return response()->json(['message'=>'The password changed successfully.']);
    }
}
