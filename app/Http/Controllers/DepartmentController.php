<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\Faculty;

class DepartmentController extends Controller
{
    public function __construct() {
        $this->middleware('SAAuth');
    }

    public function index()
    {
        $faculties = Faculty::all();
        return view('department.index', compact('faculties'));
    }

    public function view(Request $request)
    {
        $data = Department::join('faculties', 'faculties.code', '=', 'faculty_code')->select('departments.*', 'faculties.abbreviation as faculty')->orderBy('id', 'DESC')->get();
        return view('department.view', compact('data'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'faculty_code'=>'required|max:10|alpha_num',
            'name'=>'required|max:250|unique:departments,name',
            'code'=>'required|max:10|alpha_num|unique:departments,code',
            'abbreviation'=>'required|max:10|alpha|unique:departments,abbreviation',
            'description'=>'nullable|max:250',
        ]);

        $data = Department::create($request->all());
        return view('crud.response', ['name'=>'department', 'msg'=>'Stored Successfully']);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $editData = Department::find($id);
        return compact('editData');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'faculty_code'=>'required|max:10|alpha_num',
            'name'=>'required|max:250|unique:departments,name,'.$id,
            'code'=>'required|max:10|alpha_num|unique:departments,code,'.$id,
            'abbreviation'=>'required|max:10|alpha|unique:departments,abbreviation,'.$id,
            'description'=>'nullable|max:250',
        ]);

        $data = Department::find($id)->update($request->all());
        return view('crud.response', ['name'=>'department', 'msg'=>'Updated Successfully']);
    }

    public function destroy($id)
    {
       $data = Department::find($id)->delete();
       return view('crud.response', ['name'=>'department', 'msg'=>'Deleted Successfully']);
    }
}
