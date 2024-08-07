<?php

namespace App\Http\Controllers;

use App\Models\Certificates;
use Illuminate\Http\Request;

class CertificatesController extends Controller
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

        $request->validate([
            'certificates' => 'required|array',
            'certificates.*.name' => 'required|string',
            'certificates.*.certificate_no' => 'required|string',
            'certificates.*.issue_date' => 'required|string',
            'certificates.*.expiry_date' => 'required|string',
            'certificates.*.issuing_authority' => 'required|string',
        ]);

        foreach ($request->certificates as $certificate) {
            // Save each certificate record to the database
            $certificate['user_id'] = auth()->user()->id;
            Certificates::create($certificate);
        }

        return redirect(route('cvforms.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Certificates $certificates)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Certificates $certificates)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Certificates $certificates)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Certificates $certificates)
    {
        //
    }
}
