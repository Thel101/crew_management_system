<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Jobs;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Seafarer;
use App\Models\Vacancies;
use App\Models\Certificates;
use App\Models\Roles;
use App\Models\Vessels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

class UserController extends Controller
{

    public function welcome()
    {
        if(auth()->check() && auth()->user()->role == 'admin'){
            return redirect(route('dashboard'));
        }
        $jobs = Jobs::latest()->take(3)->get();
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'vessels' => Vessels::latest()->take(3)->get(),
            'jobs' => $jobs->load(['role']),
            'seafarer_count' => Seafarer::count()
        ]);
    }
    public function index()
    {
        if(auth()->user()->role == 'admin'){
            $users = User::whereIn('role', ['admin', 'staff'])->paginate(5);
            return Inertia::render('Admin/User/UserList', [
                'users' => $users
            ]);
        }
        else{
            session()->flash('message', 'Registration successful');
            return Inertia::render('User/Profile',[
                'message' => session('message')
            ]);

        }

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
        $validated['role'] = 'staff';
        $user = User::create($validated);
        if($user->role=='admin' || $user->role =='staff'){
            return redirect(route('users.index'))->with(['message'=>'New User has been created!']);
        }
        else
        {
            $seafarer= Seafarer::where('user_id', $user->id);
            return redirect(route('seafarer.profile', $seafarer->id))->with(['message'=>'Application Successful']);
        }
    }
    /**
     * Assign as admin
     */
    public function update(User $user){
        $user = User::find($user->id);
        if($user->role == 'staff'){
            $user->update([
                'role' => 'admin'
            ]);
            return redirect(route('users.index'))->with('message','User Role has been changed to!');

        }

        else{
            $user->update([
                'role' => 'staff'
            ]);
            return redirect(route('users.index'))->with('message', 'User Role has been changed to!');

        }

    }


}
