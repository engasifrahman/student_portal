<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\TutionFee;

class PaymentLedgerController extends Controller
{
    public function index()
    {
    	if (session()->has('student')) 
        {
            $user_id = session()->get('student.user_id');
        }
        else
        {
            return redirect('/dashboard');
        }

        $user = User::join('departments', 'departments.code', 'users.dept_code')->where('users.user_id', $user_id)->select('users.name', 'users.user_id', 'users.email', 'users.type', 'departments.name AS department')->first();

        $tutionfee = TutionFee::where('stud_id', $user_id)->select(DB::raw('SUM(total_fee) as total_payable'), DB::raw('SUM(paid) AS total_paid'), DB::raw('SUM(due) AS total_due'))->first();

        $semesterwise = TutionFee::join('users', 'users.user_id', 'tution_fees.stud_id')->join('departments', 'departments.code', 'tution_fees.dept_code')->join('semesters', 'semesters.code', 'tution_fees.sem_code')->where('tution_fees.stud_id', $user_id)->select('tution_fees.*', 'users.name', 'semesters.name AS semester', 'departments.name AS department')->orderBy('tution_fees.id', 'DESC')->get();

        if (isset($user) && $user->type === "Student") {

            return view('paymentledger', compact('user', 'tutionfee', 'semesterwise'));
        }
        else
        {
           	return reditrect()->back();
        }
    }

}
