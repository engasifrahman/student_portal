<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Faculty;
use App\Department;

class LoginController extends Controller
{
    public function __construct() {
        $this->middleware('UserAuth', ['except' => ['login', 'authentication']]);
    }

	public function login(){
        if (session()->has('system_admin') || session()->has('finance_admin') || session()->has('faculty_member') || session()->has('student')) 
        {
            return redirect('/dashboard');
        }
		else
		{
			return view('login');
		}
	}

    public function authentication(Request $request){
    	$email = $request->email;
    	$pass = md5($request->password);

        $result = User::where('email',$email)->where('password',$pass)->first();

    	if ($result)
        {
            if ($result->type === 'System Admin') 
            {
                session()->put('system_admin', $result);
                return redirect('/dashboard');
            }
            elseif ($result->type === 'Finance Admin') 
            {
                session()->put('finance_admin', $result);
                return redirect('/dashboard');
            }
            elseif ($result->type === 'Faculty Member') 
            {
                session()->put('faculty_member', $result);
                return redirect('/dashboard');
            }
            elseif ($result->type === 'Student') 
            {
                session()->put('student', $result);
                return redirect('/dashboard');
            }
            else
            {
                return back()->with('exception', 'Unauthorized user type');
            }
    		
    	}
    	else
        {
    		if (session()->has('system_admin')) 
            {
    			session()->forget('system_admin');
    		}
            elseif (session()->has('finance_admin')) 
            {
                session()->forget('finance_admin');
            }
            elseif (session()->has('faculty_member')) 
            {
                session()->forget('faculty_member');
            }
            elseif (session()->has('student')) 
            {
                session()->forget('student');
            }
    		return back()->with('exception', 'Wrong email or password');
    		//return redirect('/login')->with('exception', 'Wrong email or password');
    	}
    }

    public function dashboard(){

        $faculty = Faculty::count();
        $dept = Department::count();
        $student = User::where('type', 'Student')->count();
        $fm = User::where('type', 'Faculty Member')->count();

    	return view('dashboard', compact('faculty', 'dept', 'student', 'fm'));
    }

    public function logout()
    {
	    if (session()->has('system_admin')) 
        {
            session()->forget('system_admin');
        }
        elseif (session()->has('finance_admin')) 
        {
            session()->forget('finance_admin');
        }
        elseif (session()->has('faculty_member')) 
        {
            session()->forget('faculty_member');
        }
        elseif (session()->has('student')) 
        {
            session()->forget('student');
        }

        return redirect('/login');            

    }
}
