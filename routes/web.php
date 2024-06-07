<?php

use App\Http\Controllers\LikesController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Models\newUpload;
use Illuminate\Support\Facades\Route;
use App\Models\post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Artwork;
use App\Http\Controllers\ArtworkController;
use App\Http\Controllers\UserProfileController;
Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', [PostController::class,'index'])->middleware(['auth', 'verified'])
->name('dashboard');

//Show page for creating post
Route::get('/create', [PostController::class,'showCreatePost'])
->name('showCreatePost');

//Send request to controller to create post
Route::post('/create', [PostController::class,'createPost'])
->name('createPost');

//Show dedicated page for each post
Route::get('/post/{post}', [PostController::class, 'show'])->middleware(['auth', 'verified'])
->name("showPost");

//For comment
Route::post('/post', [PostController::class, 'createComment'])->middleware(['auth', 'verified'])
->name('createComment');

// Edit Post
Route::get('/post/{post}/edit', [PostController::class, 'editPost'])->middleware(['auth', 'verified'])
->name("editPost");

Route::post('/post/{post}/like', [LikesController::class, 'like'])->middleware(['auth', 'verified'])
->name('like');

Route::post('/post/{post}/unlike', [LikesController::class, 'unlike'])->middleware(['auth', 'verified'])
->name('unlike');

//Update  Post
Route::patch('/post/{post}', function($id)
{
    $post = post::findOrFail($id);
    $post->update([
        'title' => request('title'),
        'description' => request('description'),
        'image_url' => request('file_upload'),
    ]);

    return redirect('dashboard');
});



//Delete Post
Route::delete('/post/{id}', function($id)
{
    post::findOrFail($id)->delete();

    return redirect('dashboard');
});

Route::get('/profile/{user}', function(User $user)
{
    return view('profile', ['user' => $user]);
})->middleware(['auth', 'verified'])->name('UserProfile');

Route::post('/profile/upload-photos', [ProfileController::class, 'uploadprofileandcover'])->middleware(['auth', 'verified'])
->name("upload.profile.cover");
Route::get('/user/{user}', [UserProfileController::class, 'showProfile'])->middleware(['auth', 'verified'])
->name("showProfile");


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/draw', [ArtworkController::class, 'new'])->name('draw');
    Route::post('/save-drawing', [ArtworkController::class, 'saveDrawing'])->name('saveDrawing');
    Route::get('/load-drawing/{id}', [ArtworkController::class, 'loadDrawing']);
    Route::get('/load-saved-items', [ArtworkController::class, 'loadSavedItems'])->name('loadSavedItems');
});

require __DIR__.'/auth.php';
