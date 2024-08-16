<?php

namespace App\Http\Controllers;

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
        $vacancies = Vacancies::with(['role', 'vessel'])->get();
        return Inertia::render('User/Home', [
            'vacancies' => $vacancies
        ]);
    }
    public function user_list()
    {
        $users = User::whereIn('role', ['admin', 'staff'])->paginate();
        return Inertia::render('Admin/UserList', [
            'users' => $users
        ]);
    }
    public function applicant_list()
    {
        $applicants = User::where('role', 'user')->with('passport', 'seamanbooks')->paginate();
        return Inertia::render('Admin/ApplicantList', [
            'users' => $applicants,
        ]);
    }
    public function view($userid)
    {
        $user = User::find($userid);
        $cvforms = $user->cvforms;
        if ($cvforms->isEmpty()) {
            return redirect()->route('applicants.list')->with('message', 'The user has not applied for any vacancy!');
        }

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
    public function seafarer_list()
    {
        $seafarers = User::where('role', 'seafarer')->with('passport', 'seamanbooks')->get();
        $seafarersData = $seafarers->map(function ($seafarer) {
            $passport = $seafarer->passport->first();
            $passport_status = $passport->status;
            return [
                'id' => $seafarer->id,
                'name' => $seafarer->name,
                'email' => $seafarer->email,
                'passport' => $passport, // Assuming passport is a related model
                'passport_status' => $passport_status,
                'seaman_book' => $seafarer->seamanbooks->first(), // Assuming seamanbooks is a related collection
            ];
        });
        return Inertia::render('Admin/Seafarer', [
            'seafarers' => $seafarersData,
        ]);
    }
}
