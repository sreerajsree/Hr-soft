<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\personal_table;
use App\Models\Payroll;
use App\Models\User;
use App\Models\Requests;
use Auth;
use Alert;
use Illuminate\Support\Facades\Crypt;

class PayrollController extends Controller
{
    public function index()
    {
        $myreq = Requests::where('user_id', Auth::user()->id)->get();
        return view('pages.payroll', ['myreq' => $myreq]);
    }

    public function edit($id)
    {
        $users = User::where('id', Auth::user()->id)
            ->get()
            ->first();
        $employee = personal_table::join('users', 'users.id', 'personal_tables.user_id')
            ->join('payrolls', 'payrolls.user_id', 'users.id')
            ->where('personal_tables.id', Crypt::decrypt($id))
            ->select('payrolls.*', 'personal_tables.*', 'users.empcode')
            ->get()
            ->first();

        return view('pages.editpayroll', ['employee' => $employee, 'users' => $users]);
    }

    public function update(Request $request, $id)
    {
        $users = User::where('id', Auth::user()->id)
            ->get()
            ->first();
        $personal_table = Payroll::join('users', 'users.id', 'payrolls.user_id')
            ->join('personal_tables', 'personal_tables.user_id', 'users.id')
            ->select('payrolls.*')
            ->where('personal_tables.id', $id)
            ->get()
            ->first();
        $personal_table->fixed_basic_da = $request->basic_da;
        $personal_table->fixed_hra = $request->fixed_hra;
        $personal_table->fixed_med_allowance = $request->fixed_med_allowance;
        $personal_table->fixed_conveyance = $request->fixed_conveyance;
        $personal_table->fixed_epf = $request->fixed_epf;
        $personal_table->fixed_ctc = $request->fixed_ctc;
        $personal_table->shift_allowance = $request->shift_allowance;
        $personal_table->total_ctc = $personal_table->fixed_ctc + $personal_table->shift_allowance;
        $personal_table->no_of_days_payable = $request->no_of_days_payable;
        $personal_table->earned_med_allowance = $request->earned_med_allowance;
        $personal_table->earned_conveyance = $request->earned_conveyance;
        $personal_table->earned_basic_da = $request->earned_basic_da;
        $personal_table->earned_hra = $request->earned_hra;
        $personal_table->earned_epf = $request->earned_epf;
        $personal_table->earned_wages = $request->earned_wages;
        $personal_table->incentives = $request->incentives;
        $personal_table->loans = $request->loans;
        $personal_table->ben_fuel_allowance = $request->ben_fuel_allowance;
        $personal_table->ben_food_allowance = $request->ben_food_allowance;
        $personal_table->ben_shift_allowance = $request->ben_shift_allowance;
        $personal_table->total_gross_salary = $personal_table->earned_wages + $personal_table->incentives + $personal_table->ben_fuel_allowance + $personal_table->loans + $personal_table->ben_food_allowance + $personal_table->ben_shift_allowance;
        $personal_table->special_deductions = $request->special_deductions;
        $personal_table->last_esic = $request->last_esic;
        $personal_table->last_epf = $request->last_epf;
        $personal_table->govt_charges = $request->govt_charges;
        $personal_table->professional_tax = $request->professional_tax;
        $personal_table->total_deductions = $request->total_deductions;
        $personal_table->net_wages_payable = $request->net_wages_payable;
        $personal_table->save();

        Alert::toast('Payroll Updated Successfully', 'success');
        return redirect()->back();
    }

    public function view() {
        $users = User::where('id', Auth::user()->id)
            ->get()
            ->first();
        $payrolls = Payroll::join('users', 'users.id', 'payrolls.user_id')
            ->join('personal_tables', 'personal_tables.user_id', 'users.id')
            ->select('payrolls.*', 'users.*', 'personal_tables.id')
            ->get();
        return view('pages.view-payroll', ['payrolls' => $payrolls, 'users' => $users]);
    }

    public function request(Request $request) {
        $payslip = new Requests();
        $payslip->req_status = 0;
        $payslip->user_id = $request->user_id;
        $payslip->from_date = $request->from_request;
        $payslip->to_date = $request->to_request;
        $payslip->save();
        Alert::toast('Payslip Requested Successfully', 'success');
        return redirect()->back();
    }

    public function requests() {
        $preq = Requests::join('users','users.id','requests.user_id')->select('requests.*','users.name')->get();
        return view('pages.payroll-request',['preq' => $preq]);
    }

    public function payrollApprove($id)
    {
        $leave = Requests::find($id);
        $leave->req_status = 1;
        $leave->save();

        Alert::toast('Payslip Approved Successfully', 'success');
        return redirect()->back();
    }

    public function payrollReject($id)
    {
        $leave = Requests::find($id);
        $leave->req_status = 3;
        $leave->save();

        Alert::toast('Payslip Rejected Successfully', 'success');
        return redirect()->back();
    }
}
