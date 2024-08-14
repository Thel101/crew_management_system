<?php

namespace App\Http\Controllers;

use App\Models\Certificates;
use App\Models\User;
use App\Models\Vacancies;
use Inertia\Inertia;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        $vacancies = Vacancies::with(['role', 'vessel'])->get();
        return Inertia::render('User/Home', [
            'vacancies' => $vacancies
        ]);
    }
    public function user_list()
    {
        return Inertia::render('Admin/UserList', [
            'users' => User::paginate()
        ]);
    }
    public function view($userid)
    {
        $user = User::find($userid);
        $cvforms = $user->cvforms;
        $vacancies = [];
        foreach ($cvforms as $cvform) {
            $vacancies[] = $cvform->vacancy->load('role');
        }
        return Inertia::render('Admin/UserDetail', [
            'user' => $user,
            'cvform' => $user->cvforms->first(),
            'passport' => $user->passport->first(),
            'seaman_book' => $user->seamanbooks->first(),
            'certificates' => $user->certificates,
            'experiences' => $user->experiences,
            'vacancies' => $vacancies
        ]);
    }
}
