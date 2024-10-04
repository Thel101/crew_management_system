<?php

namespace App\Http\Controllers;

use App\Models\Jobs;
use App\Models\Roles;
use App\Models\Seafarer;
use App\Models\Vessels;
use Inertia\Inertia;
use Illuminate\Contracts\Queue\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        // Start with your base query on the view
        $jobQuery = DB::table('job_views');

        // Apply search filters
        $jobs = $jobQuery->when($request->search, function ($query, $search) {
            $query->whereAny([
                'vessel_name',
                'role_name',
                'joining_date',
                'port'
            ], 'like', '%' . $search . '%');
        });

        // Paginate the result (e.g., 10 items per page)
        $paginatedJobs = $jobs->paginate(10);

        // Return paginated jobs to Inertia

        return Inertia::render('Admin/Vacancies/index', [
            'jobs' => $paginatedJobs,
            'vessels' => Vessels::get(),
            'roles' => Roles::get()
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
        $validated = $request->validate($this->validateJobs());
        Jobs::create($validated);
        return redirect(route('jobs.index'));
    }
    public function assignSeafarers($role_id)
    {
        $applicants = Seafarer::with('passport', 'certificates', 'job.role', 'job.vessel')
            ->whereHas('job', function ($query) use ($role_id) {
                $query->where('id', $role_id);
            })
            ->get();
    }
    /**
     * Display the specified resource.
     */
    public function show(Request $request) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jobs $job)
    {
        $job = Jobs::with(['vessel', 'role'])->find($job->id);
        return Inertia::render('Admin/Vacancies/edit', [
            'job' => $job
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jobs $job)
    {
        $job = Jobs::find($job->id);
        $updatedJob = $request->validate($this->validateJobs());
        $job->update($updatedJob);
        return redirect(route('jobs.index'))->with(['message' => 'Job has been been modified!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jobs $jobs)
    {
        //
    }

    protected function validateJobs()
    {
        return [
            'role_id' => 'required',
            'vessel_id' => 'required',
            'description' => 'required|string',
            'count' => 'required|numeric',
            'joining_date' => 'required',
            'port' => 'required|numeric',
            'basic_salary' => 'required|numeric',
            'requirements' => 'required|string'
        ];
    }
}
