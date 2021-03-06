<?php

namespace App\Http\Controllers;

use DB;
use Session;
use Input;
use File;

use App\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Department;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) //Index file view with filter
    {
        $data = Staff::with('departments')->orderBy('created_at', 'DESC')->paginate(10);
        $department = Department::all();

        //If request is from ajax, then processing to filter data
        if($request->ajax()) {
            $str    =   $request->str;
            $dep    =   $request->dep;//dd($dep);

            $s  =   new Staff;
            $d  =   new Department;
            
            if($str != null && $dep != 0){ //If input and dropdown values are available
                $data = $s::with('departments')
                        ->where('department', $dep)
                        ->where(function($q) use ($str) {
                            $q->where('fname', 'like', '%'.$str.'%')
                            ->orWhere('lname', 'like', '%'.$str.'%')
                            ->orWhere('profile', 'like', '%'.$str.'%');
                        })
                        ->orderBy('created_at', 'DESC')
                        ->paginate(10);

                
            } else if($str != null && $dep == 0){ //If input value is set and dropdown value set to all departments
                $data = $s::with('departments')
                            ->where(function($q) use ($str) {
                                $q->where('fname', 'like', '%'.$str.'%')
                                ->orWhere('lname', 'like', '%'.$str.'%')
                                ->orWhere('profile', 'like', '%'.$str.'%');
                            })
                            ->orderBy('created_at', 'DESC')
                            ->paginate(10);

                $data_count = count($data);

                return view('search', compact('data', 'data_count'));

            } else if($str == null && $dep != 0){ //If dropdown value is not null and input is null
                $data = $s::with('departments')
                            ->where('department', $dep)
                            ->orderBy('created_at', 'DESC')
                            ->paginate(10);

            } else if($str == null && $dep == 0){ //If dropdown value is null and input is null
                $data = $s::with('departments')->orderBy('created_at', 'DESC')->paginate(10);
            }

            // returning data to view
            return view('search', ['data' => $data])->render();
        }

        //returning data if request is not from ajax
        return view('index', compact('data', 'department'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()    //Create new staff view
    {
        $department = Department::all();
        return view('staff.create', compact('department'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) // storing new staff
    {
        $fname          =   $request->fname;
        $lname          =   $request->lname;
        $department     =   $request->department;
        $image          =   $request->image;//dd($image);
        $profile        =   $request->profile;

        $path           =   null;

        //Validating data
        $validator = Validator::make($request->all(), [
            'fname'         =>  'required',
            'lname'         =>  'required',
            'department'    =>  'required',
            'profile'       =>  'required',
        ]);

        if($validator->fails()) {
            $mesg = $validator->messages();
            return response(json_encode($mesg));
        }

        //image field is optional. Check image value
        if($image != null){

            //checking if upload folder is available or not. It not creating upload folder
            $directory = public_path('assets/uploads');
            if (!File::isDirectory($directory)) {
                File::makeDirectory($directory);
            }
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move($directory, $imageName);

            $path = url('/').'/assets/uploads/'.$imageName;
        }

        $data = [
            'fname'         =>  $fname,
            'lname'         =>  $lname,
            'department'    =>  $department,
            'image'         =>  $path,
            'profile'       =>  $profile
        ];

        $s = new Staff;
        $s->fill($data);
        $s->save();

        Session::flash('message', 'New staff added!');

        return response()->json('success');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function edit(Staff $staff)  //edit staff view
    {
        $data = Staff::find($staff->id);
        $department = Department::all();
        return view('staff.edit', compact('data', 'department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Staff $staff)  //update staff
    {
        $fname          =   $request->fname;
        $lname          =   $request->lname;
        $department     =   $request->department;
        $image          =   $request->image;//dd($image);
        $profile        =   $request->profile;//dd($staff->id);

        $s = new Staff;

        $validator = Validator::make($request->all(), [
            'fname'         =>  'required',
            'lname'         =>  'required',
            'department'    =>  'required',
            'profile'       =>  'required',
        ]);

        if($validator->fails()) {
            $mesg = $validator->messages();
            return response(json_encode($mesg));
        }

        if($image != null){
            $file_name = explode('/', $staff->image);
            $file_path = public_path('assets/uploads/').end($file_name);//dd($file_path);
            if(File::exists($file_path)) {
                File::delete($file_path);
            }

            $directory = public_path('assets/uploads');
            if (!File::isDirectory($directory)) {
                File::makeDirectory($directory);
            }
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move($directory, $imageName);

            $path = url('/').'/assets/uploads/'.$imageName;

            $data = [
                'fname'         =>  $fname,
                'lname'         =>  $lname,
                'department'    =>  $department,
                'image'         =>  $path,
                'profile'       =>  $profile
            ];
        } else {
            $data = [
                'fname'         =>  $fname,
                'lname'         =>  $lname,
                'department'    =>  $department,
                'profile'       =>  $profile
            ];
        }

        $s->where('id', $staff->id)->update($data);

        Session::flash('message', 'Staff updated!');

        return response()->json('success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staff $staff)   //delete staff
    {
        $file_name = explode('/', $staff->image);

        //getting image server path
        $file_path = public_path('assets/uploads/').end($file_name);//dd($file_path);
        if(File::exists($file_path)) {
            File::delete($file_path);
        }

        $data = Staff::find($staff->id);
        $data->delete();

        Session::flash('message', 'Staff deleted!');

        return redirect()->back();
    }

    public function upload(Request $request){   //upload csv
        
        $validator = Validator::make($request->all(), [
            'file' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator);
        }

        $file = $request->file('file');
        $csvData = file_get_contents($file);
        $rows = array_map("str_getcsv", explode("\n", $csvData));
        
        //CSV headers
        $header = array_shift($rows);

        $d = new Department;

        $escapedHeader=[];

        //to converting lowercase and remove spaces
        foreach ($header as $key => $value) {
            $lheader=strtolower($value);
            $escapedItem=preg_replace('/[^a-z]/', '', $lheader);
            array_push($escapedHeader, $escapedItem);
        }

        //storing data to database
        foreach($rows as $row) {
            if (count($header) != count($row)) {
                continue;
            }

            $row = array_combine($escapedHeader, $row);//dd($row);

            $check = Department::where('name', $row['department'])->get();//dd($check);

            if(count($check) == 0){
                $d = Department::create(['name'=> $row['department']]);

                $d_id = $d->id;
            } else {
                $d_id = $check[0]->id;
            }

            Staff::create([
                'fname' => $row['firstname'],
                'lname' => $row['lastname'],
                'department' => $d_id,
                'profile' => $row['profile'],
            ]);
        }

        Session::flash('message', 'CSV file imported!');
           
        return response()->json('success');
    }
}
