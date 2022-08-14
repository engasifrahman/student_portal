<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Faculty;

class FacultyController extends Controller
{
   public function __construct() {
        $this->middleware('SAAuth');
    }

    public function index()
    {
        return view('faculty.index');
    }

    public function view(Request $request)
    {
        $data = Faculty::all();
        return view('faculty.view', compact('data'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|max:250|unique:faculties,name,',
            'code'=>'required|max:10|alpha_num|unique:faculties,code',
            'abbreviation'=>'required|max:10|alpha|unique:faculties,abbreviation',
            'description'=>'nullable|max:250',
        ]);

        $data = Faculty::create($request->all());
        return view('crud.response', ['name'=>'faculty', 'msg'=>'Stored Successfully']);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $editData = Faculty::find($id);
        return compact('editData');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required|max:250|unique:faculties,name,'.$id,
            'code'=>'required|max:10|alpha_num|unique:faculties,code,'.$id,
            'abbreviation'=>'required|max:10|alpha|unique:faculties,abbreviation,'.$id,
            'description'=>'nullable|max:250',
        ]);

        $data = Faculty::find($id)->update($request->all());
        return view('crud.response', ['name'=>'faculty', 'msg'=>'Updated Successfully']);
    }

    public function destroy($id)
    {
       $data = Faculty::find($id)->delete();
       return view('crud.response', ['name'=>'faculty', 'msg'=>'Deleted Successfully']);
    }
}
