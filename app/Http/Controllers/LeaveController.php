<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\Seafarer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leaves = Leave::with('seafarer.vessel')->paginate();

        return Inertia::render('Admin/Leaves/index', [
            'leaves' => $leaves

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
            'leave_start' => 'required',
            'leave_end' => 'required',
            'reason' => 'required'
        ]);
        $start = Carbon::parse($validated['leave_start']);
        $end = Carbon::parse($validated['leave_end']);
        $validated['count'] = $start->diffInDays($end);
        $leave = Leave::create($validated);
        $user_id = $leave->seafarer->user_id;
        return redirect(route('seafarer.profile', $user_id));
    }

    /**
     * Display the specified resource.
     */
    public function show(Leave $leave)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Leave $leave)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $leave = Leave::find($id);
        $leave->status = 'approved';
        $leave->save();
        return redirect()->back()->with(
            [
                'message' => 'Leave has been approved'
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Leave $leave)
    {
        //
    }
}
