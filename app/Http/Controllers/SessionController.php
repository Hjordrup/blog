<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{


    //Log out the user. 
    public function destroy()
    {
        auth()->logout();
        return redirect('/')->with('success', 'Goodbye');
    }

    //show Login form . 
    public function create()
    {
        return view('sessions.create');
    }

    // Login user . 
    public function store()
    {
        $attributes =  request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!auth()->attempt($attributes)) {
            return back()->withInput()->withErrors(['email' => 'Your provided credentials could not be verified']);

            //other options is to throw and error and Laravel with handle the error automatically. 
            /* throw ValidationException::withMessages([
                'email' => 'Your provided credentials could not be verified'
            ]); */
        }


        //regen session for safety reasons. 
        session()->regenerate();
        return redirect('/')->with('success', 'Welcome, back friend!');
    }
}
