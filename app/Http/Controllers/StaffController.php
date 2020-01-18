<?php

namespace App\Http\Controllers;

use App\Staff;
use App\Department;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Staff::with('departments')->paginate(10);
        $department = Department::all();
        return view('index', compact('data', 'department'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function edit(Staff $staff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Staff $staff)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staff $staff)
    {
        //
    }

    public function filter(Request $request){
        $str    =   $request->str;
        $dep    =   $request->dep;//dd($dep);

        $s  =   new Staff;
        $d  =   new Department;

        //If input and dropdown values are available
        if($str != null && $dep != 0){
            $data = $s::with('departments')
                        ->where('department', $dep)
                        ->where(function($q) use ($str) {
                            $q->where('fname', 'like', '%'.$str.'%')
                            ->orWhere('lname', 'like', '%'.$str.'%')
                            ->orWhere('profile', 'like', '%'.$str.'%');
                        })
                        ->paginate(10)
                        ->appends(['dep'=> $dep, 'str'=> $str]);

            $data_count = count($data);

            return view('search', compact('data', 'data_count'));

        } else if($str != null && $dep == 0){ //If input value is set and dropdown value set to all departments
            $data = $s::with('departments')
                        ->where(function($q) use ($str) {
                            $q->where('fname', 'like', '%'.$str.'%')
                            ->orWhere('lname', 'like', '%'.$str.'%')
                            ->orWhere('profile', 'like', '%'.$str.'%');
                        })
                        ->paginate(10)
                        ->appends(['dep'=> $dep, 'str'=> $str]);

            $data_count = count($data);

            return view('search', compact('data', 'data_count'));

        } else if($str == null && $dep != 0){ //If dropdown value is not null and input is null
            $data = $s::with('departments')
                        ->where('department', $dep)
                        ->paginate(2)
                        ->setPath(url('/'))
                        ->appends(['dep'=> $dep, 'str'=> $str]);//dd($data);

            $data_count = count($data);

            return view('search', compact('data', 'data_count'));

        } else if($str == null && $dep == 0){ //If dropdown value is null and input is null
            $data = $s::with('departments')->paginate(10)->appends(['dep'=> $dep, 'str'=> $str]);

            $data_count = count($data);

            return view('search', compact('data', 'data_count'));
        }
    }
}
