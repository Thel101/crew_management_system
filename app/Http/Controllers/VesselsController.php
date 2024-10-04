<?php

namespace App\Http\Controllers;

use App\Models\Jobs;
use App\Models\Vessels;
use Illuminate\Http\Request;
use Inertia\Inertia;

use function Laravel\Prompts\select;

class VesselsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $vesselsQuery = Vessels::query();
        $this->searchVessel($vesselsQuery, $request->search);
        $vessels = $vesselsQuery->paginate(5);
        $types = Vessels::groupBy('type')->distinct()->pluck('type');
        $flags = Vessels::groupBy('flag')->distinct()->pluck('flag');
        return Inertia::render('Admin/Vessels/index', [
            'vessels' => $vessels,
            'types' => $types,
            'flags' => $flags

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
        $validated = $request->validate($this->validateVessel());
        vessels::create($validated);
        return redirect(route('vessels.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Vessels $vessel, ?bool $option = null)
    {

        if ($option) {
            $seafarers = $vessel->seafarers()->get();
            foreach ($seafarers as $seafarer) {
                $role = $seafarer->role->name;
            }
            return Inertia::render('Admin/Vessels/seafarerlist', [
                'seafarers' => $seafarers,
                'vessel' => $vessel,
                'pagination' => false
            ]);
        } else {
            $seafarers = $vessel->seafarers()->paginate(2);
            foreach ($seafarers as $seafarer) {
                $role = $seafarer->role->name;
            }
            return Inertia::render('Admin/Vessels/seafarerlist', [
                'seafarers' => $seafarers,
                'vessel' => $vessel,
                'pagination' => true
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vessels $vessels)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vessels $vessel)
    {
        $vessel = Vessels::find($vessel->id);
        if ($vessel) {
            $validated = $request->validate($this->validateVessel());
            $vessel->update($validated);
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vessels $vessels)
    {
        //
    }
    /*
    Vessel Search
    */
    protected function searchVessel($query, $search)
    {
        return $query->when($search, function ($query, $search) {
            $query->whereAny([
                'name',
                'flag',
                'type',
                'IMO_number',
                'Trade'
            ], 'like', '%' . $search . '%');
        });
    }

    protected function validateVessel()
    {
        return [
            'name' => 'required|string|unique:vessels,name,except,id',
            'flag' => 'required|string|max:30',
            'type' => 'required|string',
            'IMO_number' => 'required|string|min:7|max:7',
            'built' => 'required|string|min:4|max:4|starts_with:1,2',
            'GRT' => 'required|string',
            'DWT' => 'required',
            'Engine' => 'required',
            'BHP' => 'required',
            'Trade' => 'required'
        ];
    }
}
