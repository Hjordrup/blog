<?php


use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Services\Newsletter;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\PostCommentsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Controller based Routes. 
Route::get('/', [PostController::class, 'index'])->name('home');
//Route model binding (Wild card has to line up with variable name)
Route::get('posts/{post:slug}', [PostController::class, 'show']);




//Show the form the middleware makes it so you need to be a guest(not signed in)
Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
//save the form
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');


//Post the comment to the backend. 
Route::post('posts/{post:slug}/comments', [PostCommentsController::class, 'store'])->middleware('auth');


//Admin routes. 
Route::get('/admin/posts/create', [AdminPostController::class, 'create'])->middleware('admin');
//Post the post to the backend. 
Route::post('admin/posts', [AdminPostController::class, 'store'])->middleware('admin');
//Admin route update post. 
Route::get('/admin/posts', [AdminPostController::class, 'index'])->middleware('admin');
//Admin route show update post. 
Route::get('/admin/posts/{post}/edit', [AdminPostController::class, 'edit'])->middleware('admin');
//Admin route do update. 
Route::patch('/admin/posts/{post}', [AdminPostController::class, 'update'])->middleware('admin');
//Admin route destroy 
Route::delete('admin/posts/{post}', [AdminPostController::class, 'destroy'])->middleware('admin');








//Logout user
Route::post('logout', [SessionController::class, 'destroy'])->middleware('auth');

//show Login user
Route::get('login', [SessionController::class, 'create'])->middleware('guest');

// Login user
Route::post('login', [SessionController::class, 'store'])->middleware('guest');


/* //Route to authors view 
Route::get('authors/{author:username}', function (User $author) {
    return view('posts.index', [
        'posts' => $author->posts,
    ]);
});
 */




//Closure based route. 
Route::post('/newsletter', function (Newsletter $newsletter) {

    //validate
    request()->validate([
        'email' => ['required', 'email']
    ]);

    try {
        $newsletter->subscribe(request('email'));
    } catch (\Exception $e) {
        throw\Illuminate\Validation\ValidationException::withMessages([
            'email' => 'This email could not be added',
        ]);
    }
    return redirect('/')->with('success', 'You are now singed up as a newsletter member');
});
