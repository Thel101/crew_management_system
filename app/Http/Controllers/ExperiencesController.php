<?php

namespace App\Http\Controllers;

use App\Models\Experiences;
use Illuminate\Http\Request;

class ExperiencesController extends Controller
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
            'ship_name' => 'required|string|max:30',
            'flag' => 'required|string|max:30',
            'ship_type' => 'required|string|max:30',
            'rank' => 'required|string|max:30',
            'GRT' => 'required|string|max:30',
            'engine_make' => 'required|string|max:30',
            'trade' => 'required|string|max:30',
            'sign_on_date' => 'required',
            'sign_off_date' => 'required',

        ]);
        $validated['user_id'] = auth()->user()->id;
        Experiences::create($validated);
        return redirect(route('cvforms.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Experiences $experiences)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Experiences $experiences)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Experiences $experiences)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Experiences $experiences)
    {
        //
    }
}
