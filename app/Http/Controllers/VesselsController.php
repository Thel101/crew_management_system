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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate($this->validateVessel());
        if ($request->file('image')) {
            $file = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/images', $file);
            $validated['image'] = $file;
        }
        vessels::create($validated);
        return redirect()->back()->with(
            [
                'message' => 'New Vessel successfully',
            ]
        );
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vessels $vessel)
    {

        $vessel = Vessels::find($vessel->id);
        if ($vessel) {

            $validated = $request->validate($this->validateVessel($vessel->id, true));
            if ($request->file('image')) {
                $file = uniqid() . $request->file('image')->getClientOriginalName();
                $request->file('image')->storeAs('public/images', $file);
                $validated['image'] = $file;
            }

            $vessel->update($validated);
            return redirect()->back()->with(
                [
                    'message' => 'Vessel information updated successfully',
                ]
            );
        }
    }
    public function changeVesselImage(Request $request)
    {
        $seafarer = Vessels::find($request->vessel_id);
        $request->validate([
            'image' => 'required|mimes:jpg,jpeg,webp,png'
        ]);
        $file = uniqid() . $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public/images', $file);
        $seafarer->update([
            'image' => $file
        ]);
        return redirect()->back()->with(['message' => 'Vessel image updated successfully']);
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

    protected function validateVessel($id = null, $update = false)
    {
        $rules = [
            'name' => 'required|string|unique:vessels,name' . ($id ? ",$id" : ''),
            'image' => 'required|mimes:jpg,jpeg,png',
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
        if ($update) {
            $rules = [
                'name' => 'required|string|unique:vessels,name' . ($id ? ",$id" : ''),
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
        return $rules;
    }
}
