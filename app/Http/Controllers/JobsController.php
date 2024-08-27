<?php

namespace App\Http\Controllers;

use App\Models\Jobs;
use App\Models\Roles;
use App\Models\Seafarer;
use Inertia\Inertia;
use App\Models\Vacancies;
use App\Models\Vessels;
use Illuminate\Http\Request;

class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return Inertia::render('Admin/Vacancies/index', [
            'jobs' => Jobs::with(['role', 'vessel'])->paginate(5),
            'roles' => Roles::all(),
            'vessels' => Vessels::all(),
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
            'role_id' => 'required',
            'vessel_id' => 'required',
            'description' => 'required|string',
        ]);
        Jobs::create($validated);
        return redirect(route('jobs.index'));
    }
    public function assignSeafarers($role_id){
        $applicants = Seafarer::
        with('passport', 'certificates','job.role','job.vessel')
        ->whereHas('job', function($query) use ($role_id) {
            $query->where('id', $role_id);
        })
        ->get();
<<<<<<< HEAD
        dd($applicants);
=======
        
>>>>>>> master
    }
    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jobs $jobs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jobs $jobs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jobs $jobs)
    {
        //
    }
}
