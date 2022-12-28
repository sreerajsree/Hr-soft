<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\personal_table;
use Auth;
use Alert;

class AttendanceController extends Controller
{
    public function index(){

        $myattendance = Attendance::join('personal_tables','personal_tables.user_id','attendances.empcode')->where('empcode', Auth::user()->id)->get();

        return view('pages.attendance', compact('myattendance'));
    }

    public function timeOut(){

        $timeout = Attendance::where('empcode', Auth::user()->id)->latest('id')->get()->first();
        $timeout->time_out = \now();
        $timeout->save(); 
        request()->session()->put('attendance', $timeout);
        Alert::toast('Time Out Successfull', 'success');
        return redirect()->route('home');
    }
}
