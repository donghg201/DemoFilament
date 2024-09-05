<?php

namespace App\Http\Controllers;

use App\Actions\ExportUserData;
use App\Actions\UpdatePassword;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showProfile()
    {
        return view('user-profile')->with([
            'user' => User::find(2),
        ]);
    }

    public function updateProfile(Request $request)
    {
        UpdatePassword::run(User::find(2), 'myPassword');
        return redirect()->back();
    }
}
