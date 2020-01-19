<?php

namespace App\Http\Controllers;

use Session;

use App\Department;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->name;

        $validator = Validator::make($request->all(), [
            'name'  =>  'required',
        ]);

        if($validator->fails()) {
            $mesg = $validator->messages();
            return response(json_encode($mesg));
        }

        $d = new Department;
        $d->fill(['name'=> $name]);
        $d->save();

        Session::flash('message', 'Department created!');

        return response()->json('success');
    }
}
