<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Announcement;
use Alert;

class AnnouncementController extends Controller
{
    public function announcements()
    {
        $announcements = Announcement::all();
        return view('pages.announcements', compact('announcements'));
    }

    public function add(Request $request)
    {
        $announcement = new Announcement();
        $announcement->date = \now();
        $announcement->heading = $request->heading;
        $announcement->event = $request->event;
        $announcement->save();

        Alert::toast('Announcement Added Successfully', 'success');

        return redirect()->route('announcements');
    }

    public function viewAnnouncements($id)
    {
        $announcement = Announcement::find($id);

        return view('pages.view-announcement', compact('announcement'));
    }

      public function update(Request $request, $id)
      {
         $announcement = Announcement::find($id);
         $announcement->date = \now();
         $announcement->heading = $request->heading;
         $announcement->event = $request->event;
         $announcement->save();

         Alert::toast('Announcement Updated Successfully', 'success');
   
        return redirect()->route('announcements');
      }

      public function delete($id)
      {
        $announcement = Announcement::find($id);
        $announcement->delete();

        Alert::toast('Announcement Deleted Successfully', 'success');

        return redirect()->route('announcements');
      }
}
