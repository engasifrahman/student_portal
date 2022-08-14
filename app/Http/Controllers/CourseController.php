<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;

class CourseController extends Controller
{
    public function __construct() {
        $this->middleware('SAAuth');
    }

    public function index()
    {
        return view('course.index');
    }

    public function view(Request $request)
    {
        $data = Course::orderBy('id', 'DESC')->get();
        return view('course.view', compact('data'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'code'=>'required|alpha_num|unique:courses,code|max:10',
            'title'=>'required|unique:courses,title|max:150',
            'credit'=>'required|numeric|max:10',
            'cost'=>'required|numeric|max:20000',
            'description'=>'nullable|max:250',
        ]);

        $data = Course::create($request->all());
        return view('crud.response', ['name'=>'course', 'msg'=>'Stored Successfully']);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $editData = Course::find($id);
        return compact('editData');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'code'=>'required|alpha_num|max:10|unique:courses,code,'.$id,
            'title'=>'required|max:150|unique:courses,title,'.$id,
            'credit'=>'required|numeric|max:10',
            'cost'=>'required|numeric|max:20000',
            'description'=>'nullable|max:250',
        ]);

        $data = Course::find($id)->update($request->all());
        return view('crud.response', ['name'=>'course', 'msg'=>'Updated Successfully']);
    }

    public function destroy($id)
    {
       $data = Course::find($id)->delete();
       return view('crud.response', ['name'=>'course', 'msg'=>'Deleted Successfully']);
    }
}
