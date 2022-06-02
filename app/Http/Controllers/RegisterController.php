<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    //

    public function create()
    {
        return view('register.create');
    }

    public function store()
    {
        //Validate data  //Rule is against the database. 
        $attributes = request()->validate([
            'name' => ['required', 'max:255'],
            'username' => ['required', 'max:255', 'min:3', Rule::unique('users', 'username')],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
            'password' => ['required', 'max:255', 'min:7'],
        ]);

        //Create user with the data. 
        $user = User::create($attributes);

        //Log in user. 
        auth()->login($user);

        //return to home page with a single page load session variable 
        return redirect('/')->with('success', 'Your account has been created');
    }
}
