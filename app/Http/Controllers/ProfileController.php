<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Alert;

class ProfileController extends Controller
{
    public function viewprofile()
    {
         $user = User::join('personal_tables', 'personal_tables.user_id', '=', 'users.id')
            ->where('users.id', auth()->user()->id)
            ->get()
            ->first();

        return view('pages.profile', compact('user'));
    }

    public function fileUpload(Request $req)
    {
        $req->validate([
            'image' => 'mimes:jpeg,jpg,png,webp|max:2048',
        ]);

        if ($req->hasfile('image')) {
            $file = $req->file('image');
            $name = $file->getClientOriginalName();
            $file->move(public_path() . '/ProfileImages/', $name);
            $imgData = $name;

            $fileModal = User::where('id', auth()->user()->id)->update(['profile_pic' => $imgData]);

            Alert::toast('Profile Picture Updated Successfully', 'success');
            return redirect()->back();
        }
    }
}
