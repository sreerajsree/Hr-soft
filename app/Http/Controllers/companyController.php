<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\personal_table;
use App\Models\User;
use Auth;
use Alert;
use Illuminate\Support\Facades\Crypt;

class companyController extends Controller
{
    function employees($companyName)
    {
        $users = User::where('id', Auth::user()->id)
            ->get()
            ->first();
        $employees = personal_table::select('companies.name', 'personal_tables.*', 'users.empcode')
            ->join('companies', 'companies.id', 'personal_tables.company_id')
            ->join('users', 'users.id', 'personal_tables.user_id')
            ->where('companies.name', $companyName)
            ->get();
        return view('pages.companyEmployees', ['employees' => $employees, 'users' => $users]);
    }

    public function add()
    {
        $users = User::where('id', Auth::user()->id)
            ->get()
            ->first();
        return view('pages.add', ['users' => $users]);
    }

    public function addDetails(Request $request)
    {
        $users = User::where('id', Auth::user()->id)
            ->get()
            ->first();
        $personal_table = new personal_table();
        $personal_table->user_id = $request->user_id;
        $personal_table->company_id = Auth::user()->company_id;
        $personal_table->fname = $request->fname;
        $personal_table->mname = $request->mname;
        $personal_table->lname = $request->lname;
        $personal_table->email = $request->email;
        $personal_table->contact = $request->contact;
        $personal_table->dob = $request->dob;
        $personal_table->blood = $request->blood;
        $personal_table->gender = $request->gender;
        $personal_table->marital = $request->marital;
        $personal_table->spouse = $request->spouse;
        $personal_table->father = $request->father;
        $personal_table->mother = $request->mother;
        $personal_table->foccupation = $request->foccupation;
        $personal_table->moccupation = $request->moccupation;
        $personal_table->emername = $request->emername;
        $personal_table->emernumber = $request->emernumber;
        $personal_table->temp_address_1 = $request->temp_address_1;
        $personal_table->temp_address_2 = $request->temp_address_2;
        $personal_table->temp_city = $request->temp_city;
        $personal_table->temp_state = $request->temp_state;
        $personal_table->temp_pincode = $request->temp_pincode;
        $personal_table->perm_address_1 = $request->perm_address_1;
        $personal_table->perm_address_2 = $request->perm_address_2;
        $personal_table->perm_city = $request->perm_city;
        $personal_table->perm_state = $request->perm_state;
        $personal_table->perm_pincode = $request->perm_pincode;
        $personal_table->qualification = $request->qualification;
        $personal_table->education = $request->education;
        $personal_table->pancard = $request->pancard;
        $personal_table->aadhaar = $request->aadhaar;
        $personal_table->uan = $request->uan;
        $personal_table->bank_name = $request->bank_name;
        $personal_table->bank_branch = $request->bank_branch;
        $personal_table->acc_number = $request->acc_number;
        $personal_table->ifsc = $request->ifsc;
        $personal_table->save();

        $stat = User::find(Auth::user()->id);
        $stat->add_status = 1;
        $stat->save();

        Alert::toast('Details Added Successfully', 'success');
        return redirect()->route('home');
    }

    public function edit($id)
    {
        $users = User::where('id', Auth::user()->id)
            ->get()
            ->first();
        $employee = personal_table::join('users', 'users.id', 'personal_tables.user_id')
            ->where('personal_tables.id', Crypt::decrypt($id))
            ->select('personal_tables.*', 'users.empcode')
            ->get()
            ->first();
        return view('pages.edit', ['employee' => $employee, 'users' => $users]);
    }

    public function update(Request $request, $id)
    {
        $users = User::where('id', Auth::user()->id)
            ->get()
            ->first();
        $personal_table = personal_table::find($id);
        $personal_table->joined_on = $request->joined_on;
        $personal_table->emp_status = $request->empstatus;
        $personal_table->fname = $request->fname;
        $personal_table->mname = $request->mname;
        $personal_table->lname = $request->lname;
        $personal_table->email = $request->email;
        $personal_table->contact = $request->contact;
        $personal_table->dob = $request->dob;
        $personal_table->blood = $request->blood;
        $personal_table->gender = $request->gender;
        $personal_table->marital = $request->marital;
        $personal_table->spouse = $request->spouse;
        $personal_table->father = $request->father;
        $personal_table->mother = $request->mother;
        $personal_table->foccupation = $request->foccupation;
        $personal_table->moccupation = $request->moccupation;
        $personal_table->emername = $request->emername;
        $personal_table->emernumber = $request->emernumber;
        $personal_table->temp_address_1 = $request->temp_address_1;
        $personal_table->temp_address_2 = $request->temp_address_2;
        $personal_table->temp_city = $request->temp_city;
        $personal_table->temp_state = $request->temp_state;
        $personal_table->temp_pincode = $request->temp_pincode;
        $personal_table->perm_address_1 = $request->perm_address_1;
        $personal_table->perm_address_2 = $request->perm_address_2;
        $personal_table->perm_city = $request->perm_city;
        $personal_table->perm_state = $request->perm_state;
        $personal_table->perm_pincode = $request->perm_pincode;
        $personal_table->qualification = $request->qualification;
        $personal_table->education = $request->education;
        $personal_table->pancard = $request->pancard;
        $personal_table->aadhaar = $request->aadhaar;
        $personal_table->uan = $request->uan;
        $personal_table->bank_name = $request->bank_name;
        $personal_table->bank_branch = $request->bank_branch;
        $personal_table->acc_number = $request->acc_number;
        $personal_table->ifsc = $request->ifsc;
        $personal_table->department = $request->department;
        $personal_table->designation = $request->designation;
        $personal_table->manager = $request->manager;
        $personal_table->save();
        $empcode = User::find($personal_table->user_id);
        $empcode->empcode = $request->empcode;
        $empcode->emp_status = $request->empstatus;
        $empcode->save();

        Alert::toast('Details Updated Successfully', 'success');
        return redirect()->back();
    }
}
