<?php

namespace App\Http\Controllers;

use App\Models\Jobs;
use App\Models\MedicalDocuments;
use Dompdf\Dompdf;
use Inertia\Inertia;
use App\Models\Seafarer;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class SeafarerController extends Controller
{

    public function index($job_id)
    {

        return Inertia::render(
            'User/PersonalDetails',
            [
                'role_id' => Jobs::with('role')->find($job_id)->role->id,
                'vessel_id' => Jobs::with('vessel')->find($job_id)->vessel->id,
                'user_name' => Auth()->user()->name,
                'user_email' => Auth()->user()->email
            ]
        );
    }


    /**
     * seafarer creation
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'role_id' => 'required',
            'profile' => 'required|file|mimes:png,jpg,jpeg,webp',
            'fullname' => 'required|string|max:30',
            'seaman_book' => 'required|string|max:10',
            'seaman_book_place' => 'required|string|max:30',
            'issue_date' => 'required',
            'expected_salary' => 'required',
            'nationality' => 'required',
            'religion' => 'required',
            'dob' => 'required',
            'height' => 'required|string|max:10',
            'weight' => 'required|integer',
            'overall_size' => 'required',
            'mobile_no' => 'required|starts_with:09',
            'email' => 'required',
            'next_of_kin' => 'required|string|max:30',
            'relationship' => 'required|string|max:20',
            'next_of_kin_mobile' => 'required|starts_with:09',

        ]);
        $validated['user_id'] = auth()->user()->id;
        $validated['vessel_id'] = $request->vessel_id;
        if ($request->file('profile')) {
            $file = uniqid() . $request->file('profile')->getClientOriginalName();
            $request->file('profile')->storeAs('public/images', $file);
            $validated['profile'] = $file;
        }

        $seafarer = Seafarer::create($validated);
        return redirect(route('passport.index', $seafarer->id));
    }


    /**
     * Display the specified resource.
     */
    public function show($seafarer_id)
    {
        $seafarer = Seafarer::find($seafarer_id);

        return Inertia::render('Admin/ApplicantDetail', [
            'applicant' => $seafarer,
            'passport' => $seafarer->passport->first(),
            'certificates' => $seafarer->certificates,
            'experiences' => $seafarer->experiences,

        ]);
    }

    /**
     * Summary of applicant_list
     * @return \Inertia\Response
     */
    public function applicantList(Request $request)
    {
        $emailQuery = Seafarer::query();
        $this->searchEmail($emailQuery, $request->search);
        $applicants = $emailQuery->with('passport', 'certificates', 'role', 'vessel')
            ->where('status', 'new')
            ->paginate(10);

        $jobsQuery = Jobs::query()->with('role', 'vessel');
        if ($request->role_id) {
            $jobsQuery->whereHas('role', function ($query) use ($request) {
                $query->where('id', $request->role_id);
            });
        }
        $jobs = $jobsQuery->get();
        return Inertia::render('Admin/ApplicantList', [
            'applicants' => $applicants,
            'jobs' => $jobs

        ]);

    }
    protected function searchEmail($query, $search){
        return $query->when($search, function($query, $search){
            $query->whereAny([
                'fullname',
                'formatted_id',
                'email',
                'seaman_book'
            ], 'like', '%' . $search . '%');
        });
    }

    /**
     * Show the seafare list data
     */
    public function seafarer_list()
    {
        $seafarers = Seafarer::where('status', 'on_boarding')->with('passport')->get();
        $seafarersData = $seafarers->map(function ($seafarer) {
            $passport = $seafarer->passport->first();
            $passport_status = $passport->status;
            return [
                'id' => $seafarer->id,
                'formatted_id' => $seafarer->formatted_id,
                'fullname' => $seafarer->fullname,
                'email' => $seafarer->email,
                'seaman_book' => $seafarer->seaman_book,
                'passport' => $passport, // Assuming passport is a related model
                'passport_status' => $passport_status,
            ];
        });
        return Inertia::render('Admin/Seafarer', [
            'seafarers' => $seafarersData,
        ]);
    }
    /**
     * show seafarer detail with medical documents and bank account
     */
    public function showSeafarer($seafarer_id)
    {
        $seafarer = Seafarer::find($seafarer_id);

        return Inertia::render('Admin/SeafarerDetail', [
            'applicant' => $seafarer,
            'passport' => $seafarer->passport->first(),
            'certificates' => $seafarer->certificates,
            'experiences' => $seafarer->experiences,

        ]);
    }

    /**
     * View pdf
     */
    public function viewpdf($seafarer_id)
    {
        $seafarer = Seafarer::find($seafarer_id);

        return Inertia('Admin/ApplicantPdf', [
            'applicant' => $seafarer,
            'passport' => $seafarer->passport->first(),
            'certificates' => $seafarer->certificates,
            'experiences' => $seafarer->experiences,

        ]);
    }
    /*change to 'on_boarding' status
     **/
    public function changeStatus(Request $request)
    {
        $seafarer = Seafarer::find($request->user_id);
        $job = Jobs::where('role_id', $request->role_id)
            ->where('vessel_id', $request->vessel_id)
            ->first();

        if ($job && $seafarer && $seafarer->status == 'new') {
            // Update the seafarer's status and job_id if conditions are met
            $seafarer->update([
                'status' => 'on_boarding'
            ]);
            return redirect(route('applicants.list'));
        }
    }
    /**
     * Sending Email for being seafarer
     */
    public function send_email($email_id)
    {
        $seafarer = Seafarer::find($email_id);
        $email = $seafarer->email;
    }
    /**
     *
     * Update the specified resource in storage.
     */
    public function update(Request $request, Seafarer $seafarer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seafarer $seafarer)
    {
        //
    }
}
