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
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    // public function index()
    // {
    //     $jobs = Jobs::with(['role', 'vessel'])->get();
    //     return Inertia::render('User/Home', [
    //         'jobs' => $jobs
    //     ]);
    // }
    public function index()
    {
        $users = User::whereIn('role', ['admin', 'staff'])->paginate(5);
        return Inertia::render('Admin/UserList', [
            'users' => $users
        ]);
    }
    /**
     * user creation
     */
    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,except,id'
        ]);
        $validated['password'] = Hash::make('password');
        $validated['role'] = 'admin';
        $user = User::create($validated);
        if($user){
            return redirect(route('users.index'))->with(['message'=>'New User has been created!']);
        }
    }


}
