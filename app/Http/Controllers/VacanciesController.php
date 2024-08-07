<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use Inertia\Inertia;
use App\Models\Vacancies;
use App\Models\Vessels;
use Illuminate\Http\Request;

class VacanciesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return Inertia::render('Admin/Vacancies/index', [
            'vacancies' => Vacancies::with(['role', 'vessel'])->get(),
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
            'availability' => 'required',

        ]);
        Vacancies::create($validated);
        return redirect(route('vacancies.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Vacancies $vacancies)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vacancies $vacancies)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vacancies $vacancies)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vacancies $vacancies)
    {
        //
    }
}
