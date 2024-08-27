<?php

namespace App\Http\Controllers;

use App\Models\Vessels;
use Illuminate\Http\Request;
use Inertia\Inertia;

class VesselsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render('Admin/Vessels/index', [
            'vessels' => Vessels::query()
                ->when($request->input('search'), function ($query, $search) {
                    $query->where(function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%')
                            ->orWhere('flag', 'like', '%' . $search . '%')
                            ->orWhere('type', 'like', '%' . $search . '%')
                            ->orWhere('IMO_number', 'like', '%' . $search . '%')
                            ->orWhere('built', 'like', '%' . $search . '%')
                            ->orWhere('Engine', 'like', '%' . $search . '%')
                            ->orWhere('Trade', 'like', '%' . $search . '%');
                    });
                })
                ->paginate(2)
                ->withQueryString(),
            'filters' => $request->input('search')
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
        ]);
        vessels::create($validated);
        return redirect(route('vessels.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Vessels $vessels)
    {
        //
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
    public function update(Request $request, Vessels $vessels)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vessels $vessels)
    {
        //
    }
}
