<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\policy;
use Alert;

class CompanypolicyController extends Controller
{
    public function viewpolicy(){
        $policy = policy::all();
        return view('pages.company-policy',['policies'=>$policy]);
    }

    public function addpolicyname(Request $req){
        $policy = new policy();
        $policy->policyheading = $req->policy_cat;
        $policy->save();
        return redirect()->back();
    }

    public function addpolicycontent(Request $req, $id){
        $policy = policy::find($id);
        $policy->policycontent = $req->policycontent;
        $policy->save();
        Alert::toast('Policy updated successfully', 'success'); 
        return redirect()->back();
    }

    public function delete($id){
        $policy = policy::find($id);
        $policy->delete();
        Alert::toast('Policy deleted successfully', 'success'); 
        return redirect()->back();
    }
}
