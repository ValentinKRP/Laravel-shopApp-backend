<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function create()
    {
        return view('login');
    }

    public function store()
    {
        request()->validate(
            [
            'user_name' => 'required',
            'password' => 'required',

            ]
        );

        if (
            auth()->attempt(
                [
                'name' => request()->user_name,
                'password' => request()->password,
                ]
            )
        ) {
            return redirect()->back()->with('succes', 'welcome back');

        ]);

        if (
            auth()->attempt([
            'name' => request()->user_name,
            'password' => request()->password,
            ])
        ) {
            return redirect('/')->with('succes', 'welcome back');

        }

        return back()->withErrors(['user_name' => 'Wrong username or password']);
    }

    public function destroy()
    {
        auth()->logout();
        return redirect('/');
    }
    public function createLoginForm()
    {
        return response()->json([
            'html' => view('components.login-form')->render()
        ]);
    }
}
