<?php

namespace App\Http\Controllers;

use App\Models\Passport;
use Illuminate\Http\Request;

class PassportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'passport_no' => 'required|string|max:10',
            'place_of_issue' => 'required|string|max:15',
            'issue_date' => 'required',
            'expiry_date' => 'required',
        ]);
        $validated['status'] = 'active';
        $validated['user_id'] = auth()->user()->id;
        Passport::create($validated);
        return redirect(route('cvforms.index'));
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
