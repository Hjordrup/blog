<?php

namespace App\Http\Controllers;

use App\Models\Post;


class PostCommentsController extends Controller
{
    public function store(Post $post)
    {

        //validate
        request()->validate([
            'body' => ['required']
        ]);



        //add comment to the given post 
        $post->comments()->create([
            'user_id' => auth()->id(),
            'body' => request('body'),
        ]);

        //redirect
        return back();
    }
}
