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
        $request->validate([
            'experiences' => 'required|array',
            'experiences.*.seafarer_id' => 'required',
            'experiences.*.ship_name' => 'required|string|max:30',
            'experiences.*.flag' => 'required|string|max:30',
            'experiences.*.ship_type' => 'required|string|max:30',
            'experiences.*.rank' => 'required|string|max:30',
            'experiences.*.GRT' => 'required|string|max:30',
            'experiences.*.trade' => 'required|string|max:30',
            'experiences.*.sign_on_date' => 'required',
            'experiences.*.sign_off_date' => 'required',

        ]);
        foreach ($request->experiences as $experience) {
            Experiences::create($experience);
        }
        return redirect(route('user.home'));
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
