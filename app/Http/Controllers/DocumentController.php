<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Documents;
use App\Models\User;
use Auth;
use Alert;

class DocumentController extends Controller
{
    public function documents()
    {
        $users = auth()->user();
        $uploaded = Documents::all();
        return view('pages.documents', compact('users', 'uploaded'));
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
                $file->move(public_path() . '/UploadedDocuments/', $name);
                $imgData[] = $name;
            }
            $fileModal = new Documents();
            $fileModal->name = json_encode($imgData);
            $fileModal->image_path = json_encode($imgData);
            $fileModal->user_id = $req->user_id;

            $fileModal->save();

            Alert::toast('Documents Added Successfully', 'success');
            return redirect()->back();
        }
    }

    public function viewDocuments()
    {
        $users = auth()->user();
        $uploaded = User::join('documents', 'users.id', '=', 'documents.user_id')->select('users.*', 'documents.name as doc_name')->get();
        return view('pages.viewdocuments', compact('users', 'uploaded'));
    }
    
}
