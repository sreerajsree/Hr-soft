<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendance;
use App\Models\personal_table;

class UserattendanceController extends Controller
{
    public function index(){
        $apsensys = User::select('users.id','users.empcode','personal_tables.fname','personal_tables.designation','users.shift','companies.name as companyname')->join('companies','companies.id','users.company_id')->join('personal_tables','personal_tables.user_id','users.id')->where('companies.name','Apsensys')->get();
        $tsr = User::select('users.id','users.empcode','personal_tables.fname','personal_tables.designation','users.shift','companies.name as companyname')->join('companies','companies.id','users.company_id')->join('personal_tables','personal_tables.user_id','users.id')->where('companies.name','The-Silicon-Review')->get();
        $cio = User::select('users.id','users.empcode','personal_tables.fname','personal_tables.designation','users.shift','companies.name as companyname')->join('companies','companies.id','users.company_id')->join('personal_tables','personal_tables.user_id','users.id')->where('companies.name','CIO-Bulletin')->get();
        return view('pages.userattendance',compact('apsensys','tsr','cio'));
    }

    public function userattendview($id){
        $myattendance = Attendance::select('attendances.*','personal_tables.fname')->join('personal_tables','personal_tables.user_id','attendances.empcode')->join('users','users.id','attendances.empcode')->where('users.id',$id)->get();
        return view('pages.attendance',compact('myattendance'));
    }
}
