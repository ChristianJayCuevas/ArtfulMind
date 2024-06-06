<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\newUpload;


class UploadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the incoming file. Refuses anything bigger than 2048 kilobyes (=2MB)
        $request->validate([
            'file_upload' => 'required|mimes:pdf,jpg,png|max:2048',
        ]);

        // Store the file in storage\app\public folder
        $file = $request->file('file_upload');
        $fileName = $file->getClientOriginalName();
        $filePath = $file->store('uploads', 'public');

        // Store file information in the database
        $uploadedFile = new newUpload();
        $uploadedFile->filename = $fileName;
        $uploadedFile->original_name = $file->getClientOriginalName();
        $uploadedFile->file_path = $filePath;
        $uploadedFile->save();

        // Redirect back to the index page with a success message
        return redirect()->route('uploads.index')
            ->with('success', "File `{$uploadedFile->original_name}` uploaded successfully.");
    }

    // shows the create form
    public function create()
    {
        return view('uploads.create');
    }

    // shows the uploads index
    public function index()
    {
        $uploadedFiles = newUpload::all();
        return view('uploads.index', compact('uploadedFiles'));
    }
}
