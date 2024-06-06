<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use App\Models\post;
use App\Models\User;
use App\Models\newUpload;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
class PostController extends Controller
{
    //Show all post and give access to the eloquent variable $posts
    public function index(Request $request)
    {

        $postsQuery = post::with('user')->latest(); // Note: Use 'user' instead of 'User'

        if ($request->has('search')) {
            $postsQuery->where(function($query) use ($request) {
                $query->where('title', 'like', '%'.$request->search.'%')
                      ->orWhere('description', 'like', '%'.$request->search.'%');
            });
        }

        $posts = $postsQuery->simplePaginate(5);

        return view('dashboard', [
            'posts' => $posts
        ]);

    }

    //Show a single post
    public function show(post $post)
    {
        $user = Auth::user();
        return view('post.show', ['post' => $post, 'user' => $user]);
    }

    //Show page for creating post
    public function showCreatePost()
    {
        return view('post.createpost');
    }

    //Send request to controller to create post
    public function createPost(Request $request)
    {

        $userID = Auth::user();
        $request->validate([
            'message_title' => ['required', 'string', 'max:255'],
            'post_message' => ['required'],
            'file_upload' => ['image']

        ]);

        $image_url = $request->hasFile('file_upload') ? $request->file('file_upload')->store('images') : null;

        post::create(
        [
            'title' => $request->message_title,
            'description' => $request->post_message,
            'image_url' => $image_url,
            'user_id' => $userID->id
        ]
        );

        return redirect('dashboard');
    }

    //Show Edit Post Page
    public function editPost(post $post)
    {
        return view('post.editpost', ['post' => $post]);
    }

    //Create Comment
    public function createComment(Request $request)
    {
        $userID = Auth::user();
        Comment::create([
            'comments' => $request->comment,
            'post_id' => $request->post_id,
            'user_id' => $userID->id
        ]
        );
        return redirect()->route('showPost', ['post' => $request->post_id]);
    }

}
