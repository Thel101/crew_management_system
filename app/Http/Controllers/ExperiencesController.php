<?php

namespace App\Http\Controllers;

use App\Models\Experiences;
use Illuminate\Http\Request;
use Inertia\Inertia;

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
            $experience = Experiences::create($experience);
            if ($experience->seafarer) { // Ensure the seafarer relationship exists
                $user_id = $experience->seafarer->user_id; // Get the user_id
            }
        }
        return redirect(route('seafarer.profile', $user_id));
    }

    /**
     * Display the specified resource.
     */
    public function show(Experiences $experience)
    {
        return Inertia::render('Admin/Seafarer/ExperienceForm', [
            'experience' => $experience
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Experiences $experience)
    {
        $request->validate([
            'ship_name' => 'required|string|max:30',
            'flag' => 'required|string|max:30',
            'ship_type' => 'required|string|max:30',
            'rank' => 'required|string|max:30',
            'GRT' => 'required|string|max:30',
            'trade' => 'required|string|max:30',
            'sign_on_date' => 'required',
            'sign_off_date' => 'required',
        ]);
        $experience->update($request->all());
        return redirect()->back()->with(['message' => 'Experience updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Experiences $experiences)
    {
        //
    }
}
