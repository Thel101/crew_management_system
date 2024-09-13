<?php

namespace App\Http\Controllers;

use App\Models\MedicalDocuments;
use Illuminate\Http\Request;

class MedicalDocumentsController extends Controller
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
            'seafarer_id'=> 'required',
            'type'=> 'required',
            'clinic'=> 'required|string|max:50',
            'document_date'=> 'required',
            'file' => 'required||mimes:pdf',
        ]);
        if ($request->file('file')) {
            $file = uniqid() . $request->file('file')->getClientOriginalName();
            $request->file('file')->storeAs('public/documents', $file);
            $validated['file'] = $file;
        }
        if(auth()->user()->role == 'admin'){
            $validated['status'] = 1;
        }
        else{
            $validated['status'] = 0;
        }
        $document = MedicalDocuments::create($validated);
        return redirect()->route('seafarer.detail', $document->seafarer_id)->with('message','Document Uploaded successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(MedicalDocuments $medicalDocuments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MedicalDocuments $medicalDocuments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MedicalDocuments $medicalDocuments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MedicalDocuments $medicalDocuments)
    {
        //
    }
}
