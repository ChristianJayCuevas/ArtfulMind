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
}
