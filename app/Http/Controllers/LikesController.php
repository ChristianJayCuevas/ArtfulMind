<?php

namespace App\Http\Controllers;

use App\Models\Likes;
use Illuminate\Http\Request;
use App\Models\post;
use App\Models\User;
class LikesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function like(post $post)
    {
        $liker = auth()->user();
        $liker->likes()->attach($post);

        return redirect()->route('dashboard')->with('success', 'Post liked');
    }

    public function unlike(post $post)
    {
        $liker = auth()->user();
        $liker->likes()->detach($post);

        return redirect()->route('dashboard')->with('success', 'Post unliked');
    }
}
