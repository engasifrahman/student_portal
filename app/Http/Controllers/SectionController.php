<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Section;

class SectionController extends Controller
{
    public function __construct() {
        $this->middleware('SAAuth');
    }

    public function index()
    {
        return view('section.index');
    }

    public function view(Request $request)
    {
        $data = Section::orderBy('id', 'DESC')->get();
        return view('section.view', compact('data'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|alpha_dash|max:15|unique:sections,name,',
            'description'=>'nullable|max:250',
        ]);

        $data = Section::create($request->all());
        return view('crud.response', ['name'=>'section', 'msg'=>'Stored Successfully']);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $editData = Section::find($id);
        return compact('editData');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required|alpha_dash|max:15|unique:sections,name,'.$id,
            'description'=>'nullable|max:250',
        ]);

        $data = Section::find($id)->update($request->all());
        return view('crud.response', ['name'=>'section', 'msg'=>'Updated Successfully']);
    }

    public function destroy($id)
    {
       $data = Section::find($id)->delete();
       return view('crud.response', ['name'=>'section', 'msg'=>'Deleted Successfully']);
    }
}
