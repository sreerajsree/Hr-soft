<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Holiday;
use Alert;
use Auth;
use Illuminate\Validation\Rule;

class HolidaysController extends Controller
{
    public function holidays(){
        if (Auth::user()->status == 0) {
            $holidays = Holiday::all();
        }
        else{
            $holidays = Holiday::where('shift',Auth::user()->shift)->get();
        }
        return view('pages.holidays',['holidays'=>$holidays]);
    }

    public function add(Request $req){
        $req->validate([
            'eventname' => 'required',
            'eventdate' => 'required|date',
            'shift' => ['required', Rule::in(['IN', 'US'])]
        ]);
        if($req->id){
            $holiday = Holiday::find($req->id);
            Alert::toast('Event updated successfully', 'success');    
        }
        else{
            Alert::toast('Event added successfully', 'success');
            $holiday = new Holiday;
        }
        $holiday->date = $req->eventdate;
        $holiday->event = $req->eventname;
        $holiday->shift = $req->shift;
        $holiday->save();
        return redirect()->back();
    }

    public function del($id){
        $data = Holiday::find(($id));
        $data->delete();
        Alert::toast('Event deleted successfully', 'success');
        return redirect()->back();
        
    }
}