<?php

namespace App\Http\Controllers;

use App\Models\Seamanbook;
use Illuminate\Http\Request;

class SeamanbookController extends Controller
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
            'seaman_book' => 'required|string|max:10',
            'place_of_issue' => 'required|string|max:15',
            'issue_date' => 'required',
            'expiry_date' => 'required',
        ]);
        $validated['status'] = 'active';
        $validated['user_id'] = auth()->user()->id;
        Seamanbook::create($validated);
        return redirect(route('cvforms.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Seamanbook $seamanbook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Seamanbook $seamanbook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Seamanbook $seamanbook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seamanbook $seamanbook)
    {
        //
    }
}
