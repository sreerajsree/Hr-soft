<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use Alert;
use Auth;

class GalleryController extends Controller
{
    public function gallery()
    {
        $galleries = Gallery::all();
        $users = auth()->user();
        return view('pages.gallery', compact('users', 'galleries'));
    }

    public function fileUpload(Request $req)
    {
        $req->validate([
            'imageFile' => 'required',
            'imageFile.*' => 'mimes:jpeg,jpg,png,webp|max:2048',
        ]);

        if ($req->hasfile('imageFile')) {
            foreach ($req->file('imageFile') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path() . '/Gallery/', $name);
                $imgData[] = $name;
            }
            $fileModal = new Gallery();
            $fileModal->name = json_encode($imgData);
            $fileModal->image_path = json_encode($imgData);
            $fileModal->user_id = auth()->user()->id;

            $fileModal->save();

            Alert::toast('Images Added Successfully', 'success');
            return redirect()->back();
        }
    }
}
