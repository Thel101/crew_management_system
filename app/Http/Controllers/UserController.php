<?php

namespace App\Http\Controllers;

use App\Models\Certificates;
use App\Models\Jobs;
use App\Models\Seafarer;
use App\Models\User;
use App\Models\Vacancies;
use Carbon\Carbon;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class UserController extends Controller
{

    public function index()
    {
        $jobs = Jobs::with(['role', 'vessel'])->get();
        return Inertia::render('User/Home', [
            'jobs' => $jobs
        ]);
    }
    public function user_list()
    {
        $users = User::whereIn('role', ['admin', 'staff'])->paginate();
        return Inertia::render('Admin/UserList', [
            'users' => $users
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
    public function update(Request $request)
    {
        $user = User::find($request->user_id);
        $user->update([
            'role' => 'seafarer'
        ]);
        return redirect(route('seafarer.list'));
    }

}
