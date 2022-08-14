<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Semester;

class SemesterController extends Controller
{
    public function __construct() {
        $this->middleware('SAAuth');
    }

    public function index()
    {
        return view('semester.index');
    }

    public function view(Request $request)
    {
        $data = Semester::orderBy('id', 'DESC')->get();
        return view('semester.view', compact('data'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|alpha_dash|max:50|unique:semesters,name,',
            'description'=>'nullable|max:250',
        ]);

        $nameArr = explode('-', $request->name);
        $season = strtolower($nameArr[0]);
        if (isset($nameArr[1])) {
            $year = $nameArr[1];
        }
        else
        {
            return response()->json(['message'=>'The given data was invalid.', 'errors'=> ['name'=>'Semester format not right']], 422);
        }

        if (is_numeric($year) && strlen($year) === 4)
        {
            if ($season == 'spring') {
               $code = substr($year, 2).'1';
            }

            else if ($season == 'summer') {
               $code = substr($year, 2).'2';
            }

            else if ($season == 'fall') {
               $code = substr($year, 2).'3';
            }
            else
            {
                return response()->json(['message'=>'The given data was invalid.', 'errors'=> ['name'=>'Semester season is wrong']], 422);
            }

        }
        else
        {
            return response()->json(['message'=>'The given data was invalid.', 'errors'=> ['name'=>'Semester year is wrong']], 422);
        }

        $published_at = date("Y-m-d");
        $published = $request->publish_result ? 'true' : 'false';

        $semester = new Semester;
        $semester->code         = $code;
        $semester->name         = $request->name;
        $semester->description  = $request->description;
        $semester->published    = $published;
        $semester->published_at = $published_at;

        $semester->save();

        return view('crud.response', ['name'=>'semester', 'msg'=>'Stored Successfully']);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $editData = Semester::find($id);
        return compact('editData');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required|alpha_dash|max:50|unique:semesters,name,'.$id,
            'description'=>'nullable|max:250',
        ]);

        $nameArr = explode('-', $request->name);
        $season = strtolower($nameArr[0]);
        if (isset($nameArr[1])) {
            $year = $nameArr[1];
        }
        else
        {
            return response()->json(['message'=>'The given data was invalid.', 'errors'=> ['name'=>'Semester format not right']], 422);
        }

        if (is_numeric($year) && strlen($year) === 4)
        {
            if ($season == 'spring') {
               $code = substr($year, 2).'1';
            }

            else if ($season == 'summer') {
               $code = substr($year, 2).'2';
            }

            else if ($season == 'fall') {
               $code = substr($year, 2).'3';
            }
            else
            {
                return response()->json(['message'=>'The given data was invalid.', 'errors'=> ['name'=>'Semester season not right']], 422);
            }

        }
        else
        {
            return response()->json(['message'=>'The given data was invalid.', 'errors'=> ['name'=>'Semester year not right']], 422);
        }

        $published_at = date("Y-m-d");
        $published = $request->publish_result ? 'true' : 'false';

        $semester = Semester::find($id);
        $semester->code         = $code;
        $semester->name         = $request->name;
        $semester->description  = $request->description;
        $semester->published    = $published;
        $semester->published_at = $published_at;

        $semester->update();

        return view('crud.response', ['name'=>'semester', 'msg'=>'Updated Successfully']);
    }

    public function destroy($id)
    {
       $data = Semester::find($id)->delete();
       return view('crud.response', ['name'=>'semester', 'msg'=>'Deleted Successfully']);
    }
}
