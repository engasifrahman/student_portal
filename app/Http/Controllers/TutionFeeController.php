<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Course;
use App\Semester;
use App\TutionFee;
use App\Department;

class TutionFeeController extends Controller
{
    public function __construct() {
        $this->middleware('FAAuth');
    }

    public function index()
    {
        $semesters = Semester::orderBy('id', 'DESC')->get();
        return view('tutionfee.index', compact('semesters'));
    }

    public function search(Request $request)
    {
        $user = User::join('faculties', 'faculties.code', 'users.faculty_code')->join('departments', 'departments.code', 'users.dept_code')->join('semesters', 'semesters.code', 'users.sem_code')->where('users.user_id', $request->user_id)->select('users.*', 'semesters.name AS semester', 'departments.name AS department', 'faculties.name AS faculty')->orderBy('users.id', 'DESC')->first();

        $tutionfee = TutionFee::where('stud_id', $request->user_id)->select(DB::raw('SUM(total_fee) as total_payable'), DB::raw('SUM(paid) AS total_paid'), DB::raw('SUM(due) AS total_due'))->first();

        if (!isset($user))
        {
            return response()->json(['message'=>'The given data was invalid.', 'errors'=> ['user_id'=>'This user id not associated with any student']], 422);
        }

        if ($user->type === "Student") {

            return view('tutionfee.result', compact('user', 'tutionfee'));

        }
        else
        {
            return response()->json(['message'=>'The given data was invalid.', 'errors'=> ['user_id'=>'This user id not associated with any student']], 422);
        }
    }

    public function view(Request $request)
    {
        $data = TutionFee::join('users', 'users.user_id', 'tution_fees.stud_id')->join('departments', 'departments.code', 'tution_fees.dept_code')->join('semesters', 'semesters.code', 'tution_fees.sem_code')->where('tution_fees.stud_id', $request->user_id)->select('tution_fees.*', 'users.name', 'semesters.name AS semester', 'departments.name AS department')->orderBy('tution_fees.id', 'DESC')->get();

            return view('tutionfee.view', compact('data'));
    }

    public function edit($id)
    {
        $editData = TutionFee::where('tution_fees.id', $id)->first();
        return compact('editData');
    }

    public function update(Request $request, $id)
    {

        $this->validate($request,[
            'add_payment'=>'nullable|min:10|max:1000000|numeric',
            'deduct_payment'=>'nullable|min:10|max:1000000|numeric',
        ]);

        $tutionfee = TutionFee::find($id);

        if (!empty($request->add_payment))
        {
        	$tutionfee->paid += $request->add_payment;
        	$tutionfee->due -= $request->add_payment;
        }
        if (!empty($request->deduct_payment))
        {
        	$tutionfee->paid -= $request->deduct_payment;
        	$tutionfee->due += $request->deduct_payment;
        }

        $tutionfee->update();

        return view('crud.response', ['name'=>'tutionfee', 'msg'=>'Payment Updated Successfully', 'user_id'=>$request->user_id]);
    }

}
