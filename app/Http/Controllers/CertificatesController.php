<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Certificates;
use App\Models\Seafarer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'certificates' => 'required|array',
            'certificates.*.seafarer_id' => 'required',
            'certificates.*.name' => 'required|string',
            'certificates.*.certificate_no' => 'required|string',
            'certificates.*.issue_date' => 'required|string',
            'certificates.*.expiry_date' => 'required|string',
            'certificates.*.issuing_authority' => 'required|string',
            'certificates.*.cert_image' => 'required',
        ]);

        foreach ($validated['certificates'] as $certificate) {
            // Save each certificate record to the database
            if (isset($certificate['cert_image'])) {
                $file = uniqid() . '_' . $certificate['cert_image']->getClientOriginalName();
                $certificate['cert_image']->storeAs('public/images', $file);
                $certificate['cert_image'] = $file;
            }
            Certificates::create($certificate);
        }
        $hasExistingCertificate = collect($validated['certificates'])->contains('existing', true);
        $seafarer = Seafarer::find($validated['certificates'][0]['seafarer_id']);
        // Redirect based on the 'existing' value
        if ($hasExistingCertificate) {
            return redirect(route('user.home'));
        } else {
            return redirect()->back()->with(['applicant' => $seafarer]);
        }
    }
    /**
     * Approve or Decline Certificate
     */
    public function changeStatus($id)
    {
        $certificate = Certificates::find($id);
        if ($certificate) {
            if ($certificate->status == 'pending') {
                $certificate->update(['status' => 'active']);
                return redirect()->back()->with([$id => $certificate->seafarer_id]);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Certificates $certificate)
    {
        return Inertia::render('Admin/Seafarer/CertificateForm', [
            'certificate' => $certificate
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Certificates $certificate)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'certificate_no' => 'required|string',
            'issue_date' => 'required|string',
            'expiry_date' => 'required|string',
            'issuing_authority' => 'required|string',
        ]);
        $certificate->update($validated);
        return redirect()->back()->with(['message' => 'Certificate updated successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Certificates $certificates)
    {
        //
    }
}
