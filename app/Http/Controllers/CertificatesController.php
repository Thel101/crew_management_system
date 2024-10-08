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
            'certificates.*.seafarer_id' => 'required',
            'certificates.*.name' => 'required|string',
            'certificates.*.certificate_no' => 'required|string',
            'certificates.*.issue_date' => 'required|string',
            'certificates.*.expiry_date' => 'required|string',
            'certificates.*.issuing_authority' => 'required|string',
            'certificates.*.cert_image' => 'required',
        ]);

        foreach ($request->certificates as $certificate) {
            // Save each certificate record to the database
            if (isset($certificate['cert_image'])) {
                $file = uniqid() . '_' . $certificate['cert_image']->getClientOriginalName();
                $certificate['cert_image']->storeAs('public/images', $file);
                $certificate['cert_image'] = $file;
            }
            Certificates::create($certificate);
        }

        return redirect(route('user.home'));
    }
    /**
     * Approve or Decline Certificate
     */
    public function changeStatus($id){
        $certificate = Certificates::find($id);
        if($certificate){
            if($certificate->status == 'pending'){
                $certificate->update(['status' => 'active']);
                return redirect(route('applicant.detail', $certificate->seafarer_id))->with(['message'=>'Documents have been approved!']);
            }
        }
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
