<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Documents;
use App\Models\Leave;
use App\Models\Trainee;
use Auth;
use Alert;
use Carbon\Carbon;

use App\Models\Holiday;

class LeaveController extends Controller
{
    public function leave()
    {
        $users = auth()->user();
        $approvedHalfday = Leave::where('user_id', Auth::user()->id)
            ->where('status', 'Approved')
            ->where('leave_type', 'Half Day')
            ->get()->sum('leave_count');
        $approvedHalfdaySpecial = Leave::where('user_id', Auth::user()->id)
            ->where('status', 'Approved')
            ->where('leave_type', 'Loss of Pay (Half Day)')
            ->get()->sum('leave_count');
        $appliedleavesCasual = Leave::where('user_id', auth()->user()->id)
            ->where('leave_type', 'Casual Leave')
            ->count();
        $appliedleavesHalfday = Leave::where('user_id', auth()->user()->id)
            ->where('leave_type', 'Half Day')
            ->count();
        $appliedleavesLossOfPayNormal = Leave::where('user_id', auth()->user()->id)
            ->where('leave_type', 'Loss of Pay')
            ->count();
        $appliedleavesLossOfPaySpecial = Leave::where('user_id', auth()->user()->id)
            ->where('leave_type', 'Loss of Pay (Half Day)')
            ->count();
        $approvedleavesCasual = Leave::where('user_id', auth()->user()->id)
            ->where('status', 'Approved')
            ->where('leave_type', 'Casual Leave')
            ->selectraw('DATEDIFF(leave_end_date, leave_start_date) as days')
            ->get()->sum('days');
        $countapprovedCasual = Leave::where('user_id', auth()->user()->id)
            ->where('status', 'Approved')
            ->where('leave_type', 'Casual Leave')
            ->count();
        $approvedleavesLossOfPay = Leave::where('user_id', auth()->user()->id)
            ->where('status', 'Approved')
            ->where('leave_type', 'Loss of Pay')
            ->count();
        $approvedcount = Leave::where('user_id', auth()->user()->id)
            ->where('status', 'Approved')
            ->where('leave_type', '!=', 'Loss of Pay')
            ->get()->sum('leave_count');

        $status = Leave::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->get();
        $balanceCasual = 20 - $approvedleavesCasual;
        $totalBalanceLeaves = $balanceCasual - $approvedHalfday;
        $totalBalanceLeavesnew = $totalBalanceLeaves - $approvedcount;
        $approvedleavesCasualnew = $approvedleavesCasual + $countapprovedCasual;
        $takenleaves =  $approvedleavesCasualnew;


        $totalLossofPay = Leave::where('user_id', auth()->user()->id)
            ->where('leave_type', 'Loss of Pay')
            ->where('status', 'Approved')
            ->selectraw('DATEDIFF(leave_end_date, leave_start_date) as days')
            ->get()->sum('days');
        $totalLossofPaycount = Leave::where('user_id', auth()->user()->id)
            ->where('status', 'Approved')
            ->where('leave_type', 'Loss of Pay')
            ->count();
        $grandtotalLossofPay = $totalLossofPay + $totalLossofPaycount;


        $lossofpaytotal = $approvedHalfdaySpecial + $grandtotalLossofPay;

        $penaltyDeduction = $lossofpaytotal * 500;


        $remainingLeaves = 20 - ($approvedHalfday + $approvedleavesCasualnew);
        if (Auth::user()->status == 0) {
            $holidays = Holiday::all();
        } else {
            $holidays = Holiday::where('shift', Auth::user()->shift)->get();
        }

        return view(
            'pages.leave',
            compact(
                'users',
                'appliedleavesCasual',
                'approvedleavesCasualnew',
                'status',
                'balanceCasual',
                'appliedleavesLossOfPayNormal',
                'penaltyDeduction',
                'approvedleavesLossOfPay',
                'approvedHalfday',
                'appliedleavesHalfday',
                'totalBalanceLeavesnew',
                'takenleaves',
                'grandtotalLossofPay',
                'remainingLeaves',
                'appliedleavesLossOfPaySpecial',
                'approvedHalfdaySpecial',
                'lossofpaytotal',
                'holidays',
            )
        );
    }

    public function leaveRequest(Request $req)
    {
        $req->validate([
            'leave_type' => 'required',
            'date-picker-leave_start_date' => 'required',
            'date-picker-leave_end_date' => 'required',
            'leave_reason' => 'required',
        ]);
        $leave = new Leave();
        $leave->user_id = auth()->user()->id;
        $leave->company_id = auth()->user()->company_id;
        $leave->leave_type = $req->leave_type;
        $leave->leave_count = ($req->leave_type == 'Half Day' ? 0.5 : $req->leave_type == 'Loss of Pay (Half Day)') ? 0.5 : $req->Total_Leave;
        $leave->leave_start_date = Carbon::parse($req['date-picker-leave_start_date'])->format('Y-m-d');
        $leave->leave_end_date = Carbon::parse($req['date-picker-leave_end_date'])->format('Y-m-d');
        $leave->leave_reason = $req->leave_reason;
        $leave->status = 'Pending';
        $leave->save();

        Alert::toast('Leave Requested Successfully', 'success');
        return redirect()->back();
    }

    public function leaveApplications()
    {
        $users = auth()->user();
        $leaves = Leave::join('users', 'users.id', '=', 'leaves.user_id')
            ->join('companies', 'companies.id', '=', 'leaves.company_id')
            ->select('leaves.*', 'users.name as username', 'companies.name as company_name')
            ->orderByRaw('FIELD(leaves.status, "Pending", "Approved", "Rejected")')
            ->get(10);

        $traineeLeaves = Trainee::join('users', 'users.id', '=', 'trainees.user_id')
            ->join('companies', 'companies.id', '=', 'trainees.company_id')
            ->select('trainees.*', 'users.name as username', 'companies.name as company_name')
            ->orderByRaw('FIELD(trainees.status, "Pending", "Approved", "Rejected")')
            ->get(10);
        return view('pages.leave-applications', compact('leaves', 'users', 'traineeLeaves'));
    }

    public function leaveApprove($id)
    {
        $leave = Leave::find($id);
        $leave->status = 'Approved';
        $leave->save();

        Alert::toast('Leave Approved Successfully', 'success');
        return redirect()->back();
    }

    public function leaveReject($id)
    {
        $leave = Leave::find($id);
        $leave->status = 'Rejected';
        $leave->save();

        Alert::toast('Leave Rejected Successfully', 'success');
        return redirect()->back();
    }


    public function traineesleave()
    {
        $leaveDetails = Trainee::join('users', 'users.id', '=', 'trainees.user_id')
            ->where('trainees.user_id', auth()->user()->id)
            ->where('trainees.status', 'Approved')
            ->select('trainees.*', 'users.name as username')
            ->get();
        $users = auth()->user();
        $traineeStatus = Trainee::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->get();
        $appliedHalfDay = Trainee::where('user_id', auth()->user()->id)
            ->where('leave_type', 'Half Day')
            ->count();
        $approvedHalfDay = Trainee::where('user_id', auth()->user()->id)
            ->where('status', 'Approved')
            ->where('leave_type', 'Half Day')
            ->get()->sum('leave_count');
        $appliedCasual = Trainee::where('user_id', auth()->user()->id)
            ->where('leave_type', 'Casual Leave')
            ->count();
        $approvedCasual = Trainee::where('user_id', auth()->user()->id)
            ->where('status', 'Approved')
            ->where('leave_type', 'Casual Leave')
            ->get()->sum('leave_count');
        $appliedLossOfPay = Trainee::where('user_id', auth()->user()->id)
            ->where('leave_type', 'Loss of Pay')
            ->count();
        $approvedLossOfPay = Trainee::where('user_id', auth()->user()->id)
            ->where('status', 'Approved')
            ->where('leave_type', 'Loss of Pay')
            ->get()->sum('leave_count');
        $appliedLossOfPaySpecial = Trainee::where('user_id', auth()->user()->id)
            ->where('leave_type', 'Loss of Pay (Half Day)')
            ->count();
        $approvedLossOfPaySpecial = Trainee::where('user_id', auth()->user()->id)
            ->where('status', 'Approved')
            ->where('leave_type', 'Loss of Pay (Half Day)')
            ->get()->sum('leave_count');

        $remainingLeaves = 1 - ($approvedHalfDay + $approvedCasual);
        $totalLossofPaycount = $approvedLossOfPaySpecial +  $approvedLossOfPay;
        $penaltyCasual = $approvedHalfDay * 500;
        $penaltyLossOfPay = $totalLossofPaycount * 500;


        return view('pages.trainees', compact(
            'users',
            'traineeStatus',
            'appliedHalfDay',
            'approvedHalfDay',
            'remainingLeaves',
            'appliedCasual',
            'approvedCasual',
            'leaveDetails',
            'appliedLossOfPay',
            'approvedLossOfPay',
            'appliedLossOfPaySpecial',
            'approvedLossOfPaySpecial',
            'totalLossofPaycount',
            'penaltyLossOfPay',
            'penaltyCasual'
        ));
    }


    public function traineeRequest(Request $request)
    {
        $trainee = new Trainee();
        $trainee->user_id = auth()->user()->id;
        $trainee->company_id = auth()->user()->company_id;
        $trainee->leave_type = $request->leave_type;
        $trainee->leave_count = ($request->leave_type == 'Half Day' ? 0.5 : $request->leave_type == 'Loss of Pay (Half Day)') ? 0.5 : 1;
        $trainee->leave_reason = $request->leave_reason;
        $trainee->leave_date = Carbon::parse($request['date-picker-leave_date'])->format('Y-m-d');
        $trainee->status = 'Pending';
        $trainee->save();
        Alert::toast('Leave Requested Successfully', 'success');
        return redirect()->back();
    }

    public function tleaveApprove($id)
    {
        $leave = Trainee::find($id);
        $leave->status = 'Approved';
        $leave->save();

        Alert::toast('Leave Approved Successfully', 'success');
        return redirect()->back();
    }

    public function tleaveReject($id)
    {
        $leave = Trainee::find($id);
        $leave->status = 'Rejected';
        $leave->save();

        Alert::toast('Leave Rejected Successfully', 'success');
        return redirect()->back();
    }
}