<?php

namespace App\Http\Controllers;

use App\Models\Passport;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PassportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($seafarer_id)
    {
        if(auth()->user()->role != 'admin'){
            return Inertia::render('User/PassportForm',[
                'seafarer_id' => $seafarer_id
            ]);
        }
        return Inertia::render('Admin/Seafarer/SeafarerPassportForm',[
            'seafarer_id' => $seafarer_id
        ]);


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'seafarer_id' => 'required',
            'passport_no' => 'required|string|max:10|unique:passports,passport_no,except,id',
            'place_of_issue' => 'required|string|max:15',
            'issue_date' => 'required',
            'expiry_date' => 'required',
        ]);
        $validated['status'] = 'active';
        Passport::create($validated);
        return redirect(route('user.home'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Passport $passport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Passport $passport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Passport $passport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Passport $passport)
    {
        //
    }
}
