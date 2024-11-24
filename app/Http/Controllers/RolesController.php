<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $roleQuery = Roles::query();
        $this->searchRole($roleQuery, $request->search);
        $roles = $roleQuery->paginate(5);
        return Inertia::render('Admin/Roles/index', [
            'roles' => $roles
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
        $validated = $request->validate($this->validateRole());
        Roles::create($validated);
        return redirect(route('roles.index'))->with(['message' => 'New Role has been created!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Roles $roles) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Roles $role)
    {
        $role = Roles::find($role->id);
        return Inertia::render('Admin/Roles/edit', [
            'role' => $role
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Roles $role)
    {
        $updateRole = Roles::find($role->id);
        $validated = $request->validate($this->validateRole($role->id));
        $updateRole->update($validated);
        return redirect(route('roles.index'))->with(['message' => 'Role has been been modified!']);
    }
    /**
     * validation
     */

    protected function validateRole($id = null)
    {
        return [
            'name' => [
                'required',
                'string',
                'max:30',
                Rule::unique('roles', 'name')->ignore($id),
            ],
            'description' => 'required|max:100'
        ];
    }
    /**
     * search feature
     */
    protected function searchRole($query, $search)
    {
        return $query->when($search, function ($query, $search) {
            $query->where(
                'name',
                'like',
                '%' . $search . '%'
            );
        });
    }
}
