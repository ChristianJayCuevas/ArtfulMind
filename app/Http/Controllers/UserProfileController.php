<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\post;
use App\Models\User;
class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showProfile(post $post)
    {
        $user = Auth::user();
        return view('userprofile', ['user' => $user, 'post' => $post]);
    }

    public function uploadPhotos(Request $request, User $user)
    {
        // Check if the authenticated user is the same as the user being updated
        if ($request->user()->id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        if ($request->hasFile('cover_photo')) {
            $coverPhoto = $request->file('cover_photo');
            $coverPhotoPath = $coverPhoto->store('cover-photos', 'public');
            $user->cover_photo = $coverPhotoPath;
        }

        if ($request->hasFile('profile_photo')) {
            $profilePhoto = $request->file('profile_photo');
            $profilePhotoPath = $profilePhoto->store('profile-photos', 'public');
            $user->profile_photo = $profilePhotoPath;
        }

        $user->save();

        return redirect()->route('UserProfile', $user)->with('success', 'Photos uploaded successfully!');
    }
}
