<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Jobs;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Seafarer;
use App\Models\Vacancies;
use App\Models\Certificates;
use App\Models\Vessels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

class UserController extends Controller
{

    public function welcome()
    {
        session()->flash('message', 'Registration successful');
        if(auth()->check() && auth()->user()->role == 'admin'){
            return redirect(route('dashboard'));
        }
        return Inertia::render('User/Profile', [
            'message' => session('message')
        ]);
    }
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
