<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create()
    {
        return view('signup');
    }

    public function store()
    {
        request()->validate([
            'user_name' => 'required|min:5|max:50',
            'password' => 'required|min:7|max:50',
        ]);

        $user = User::create([
            'name' => request()->user_name,
            'password' => bcrypt(request()->password),
        ]);
        auth()->login($user);
        session()->flash('succes', 'Your count has been created');
        return redirect('/');
    }
}
