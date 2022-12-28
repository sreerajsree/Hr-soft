<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\personal_table;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Announcement;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Auth;
use Alert;
// use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $birthday = personal_table::select('dob','fname','lname','company_id')->whereMonth('dob', '=', Carbon::now()->format('m'))->whereDay('dob', '=', Carbon::today()->addDay()->format('d'))->get();
        $anniversary = personal_table::select('joined_on','fname','lname','company_id')->whereMonth('joined_on', '=', Carbon::now()->format('m'))->whereDay('joined_on', '=', Carbon::today()->addDay()->format('d'))->get();
        $users = User::join('personal_tables', 'personal_tables.user_id', '=', 'users.id')
            ->where('users.id', auth()->user()->id)
            ->get()
            ->first();

        $announcements = Announcement::orderBy('id', 'desc')->get();

        $totalApsensys = User::where('company_id', 3)->count();
        $trainingApsensys = User::where('company_id', 3)
            ->where('emp_status', 'Training')
            ->count();
        $permanentApsensys = User::where('company_id', 3)
            ->where('emp_status', 'Permanent')
            ->count();
        $noticeApsensys = User::where('company_id', 3)
            ->where('emp_status', 'Notice')
            ->count();
        $inactiveApsensys = User::where('company_id', 3)
            ->where('emp_status', 'Resigned')
            ->count();

        $totalTSR = User::where('company_id', 1)->count();
        $trainingTSR = User::where('company_id', 1)
            ->where('emp_status', 'Training')
            ->count();
        $permanentTSR = User::where('company_id', 1)
            ->where('emp_status', 'Permanent')
            ->count();
        $noticeTSR = User::where('company_id', 1)
            ->where('emp_status', 'Notice')
            ->count();
        $inactiveTSR = User::where('company_id', 1)
            ->where('emp_status', 'Resigned')
            ->count();

        $totalCB = User::where('company_id', 2)->count();
        $trainingCB = User::where('company_id', 2)
            ->where('emp_status', 'Training')
            ->count();
        $permanentCB = User::where('company_id', 2)
            ->where('emp_status', 'Permanent')
            ->count();
        $noticeCB = User::where('company_id', 2)
            ->where('emp_status', 'Notice')
            ->count();
        $inactiveCB = User::where('company_id', 2)
            ->where('emp_status', 'Resigned')
            ->count();


        return view('pages.dashboard', compact('users','anniversary', 'birthday', 'totalApsensys', 'trainingApsensys', 'permanentApsensys', 'noticeApsensys', 'inactiveApsensys', 'totalTSR', 'trainingTSR', 'permanentTSR', 'noticeTSR', 'inactiveTSR', 'totalCB', 'trainingCB', 'permanentCB', 'noticeCB', 'inactiveCB', 'announcements'));
    }


    public function add(Request $request)
    {
        $adduser = new User;
        $adduser->company_id = $request->id;
        $adduser->name = $request->name;
        $adduser->email = $request->email;
        $adduser->shift = $request->shift;
        $adduser->password =  Hash::make($request->password);
        $adduser->save();

        Alert::toast('Employee Added Successfully', 'success');

        return redirect()->back();
    }

}
