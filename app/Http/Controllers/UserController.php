<?php

namespace App\Http\Controllers;

use App\Models\Certificates;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        return Inertia::render('User/Home');
    }
    public function user_list()
    {
        return Inertia::render('Admin/UserList', [
            'users' => User::all()
        ]);
    }
    public function view($userid)
    {
        $user = User::find($userid);

        return Inertia::render('Admin/UserDetail', [
            'user' => $user,
            'cvform' => $user->cvforms()->first(),
            'passport' => $user->passport->first(),
            'seaman_book' => $user->seamanbooks->first(),
            'certificates' => $user->certificates
        ]);
    }
}
