<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Passport;
use App\Models\Seafarer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PassportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($seafarer_id)
    {
        if (auth()->user()->role != 'admin') {
            return Inertia::render('User/PassportForm', [
                'seafarer_id' => $seafarer_id
            ]);
        }
        return Inertia::render('Admin/Seafarer/SeafarerPassportForm', [
            'seafarer_id' => $seafarer_id
        ]);
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
            'expiry_date' => ['required', 'date', function ($attribute, $value, $fail) {
                $expiryDate = Carbon::parse($value);
                $minExpiryDate = Carbon::today()->addMonths(6);
                if ($expiryDate->lte($minExpiryDate)) {
                    $fail('The expiry date must be at least 6 months from today.');
                }
            }],
        ]);
        $validated['status'] = 'active';
        Passport::create($validated);
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
    public function edit($id)
    {
        $passport = Passport::find($id);
        $seafarer = Seafarer::find($passport->seafarer_id);
        return Inertia::render('Admin/Seafarer/PassportForm', [
            'passport' => $passport,
            'seafarer' => $seafarer
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Passport $passport)
    {
        $validated = $request->validate([
            'passport_no' => [
                'required',
                'string',
                'max:10',
                Rule::unique('passports', 'passport_no')->ignore($passport->id),
            ],
            'place_of_issue' => 'required|string|max:15',
            'issue_date' => 'required',
            'expiry_date' => ['required', 'date', function ($attribute, $value, $fail) {
                $expiryDate = Carbon::parse($value);
                $minExpiryDate = Carbon::today()->addMonths(6);
                if ($expiryDate->lte($minExpiryDate)) {
                    $fail('The expiry date must be at least 6 months from today.');
                }
            }],
        ]);
        $validated['status'] = 'active';
        $passport->update($validated);
        return redirect()->back()->with(['message' => 'Passport has been updated!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Passport $passport)
    {
        //
    }
}
