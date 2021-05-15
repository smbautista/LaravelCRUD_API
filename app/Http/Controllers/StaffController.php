<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Validator;


class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staffs = Staff::all();
        return response()->json($staffs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'first_name' => ['required'],
            'last_name' => ['required'],
            'password' => ['required','min:8'],
            'email' => ['required','unique:staff'],
            'username' => ['required'],
            'user_role' => "required"
        ]);

        // $staff = new Staff();
        // $staff->first_name = $request->firstname;
        // $staff->save()

        if($validation->fails()) {
            return response()->json($validation->errors());
        }

        $staff  = Staff::create($validation->validated());
        return response()->json($staff);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function getById(Request $request)
    {
        $staff = Staff::find($request->id);
        if($staff) {
            return response()->json($staff);
        }

        return response()->json("Not Found");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'password' => ['min:8'],
            'email' => ['unique:staff'],
        ]);

        if($validation->fails()) {
            return response()->json($validation->errors());
        }

        $staff = Staff::find($request->id);

        if($staff) {
            $staff->update($request->all());
            return response()->json($staff);
        }
        
        return "Not Found";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $staff = Staff::find($request->id);
        if($staff) {
            $staff->delete();
            return "Successfully deleted";
        }

        return "Not found";
    }
}
