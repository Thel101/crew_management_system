<?php

namespace App\Http\Controllers;

use App\Models\cvforms;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CvformsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($vacancy_id)
    {
        return Inertia::render(
            'User/CVForm',
            [
                'vacancy_id' => $vacancy_id
            ]
        );
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
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'vacancy_id' => 'required',
            'profile_pic' => 'required|file|mimes:png,jpg,jpeg,webp',
            'fullname' => 'required|string|max:30',
            'rank' => 'required',
            'expected_salary' => 'required',
            'nationality' => 'required',
            'religion' => 'required',
            'dob' => 'required',
            'place_of_birth' => 'required|string|max:30',
            'height' => 'required|string|max:10',
            'weight' => 'required|integer',
            'overall_size' => 'required',
            'safety_shoe_size' => 'required',
            'mobile_no' => 'required|starts_with:09',
            'email' => 'required',
            'next_of_kin' => 'required|string|max:30',
            'relationship' => 'required|string|max:20',
            'next_of_kin_phone' => 'required|starts_with:09',
            'next_of_kin_email' => 'required',
            'next_of_kin_address' => 'required|string|max:80'
        ]);
        $validated['user_id'] = auth()->user()->id;

        if ($request->file('profile_pic')) {
            $file = uniqid() . $request->file('profile_pic')->getClientOriginalName();
            $request->file('profile_pic')->storeAs('public/images', $file);
            $validated['profile_pic'] = $file;
        }
        cvforms::create($validated);
        dd('success');

        return redirect(route('cvforms.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(cvforms $cvforms)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(cvforms $cvforms)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, cvforms $cvforms)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(cvforms $cvforms)
    {
        //
    }
}
