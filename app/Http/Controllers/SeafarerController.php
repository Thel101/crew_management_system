<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Models\Jobs;
use Inertia\Inertia;
use App\Models\Roles;
use App\Models\Seafarer;
use Illuminate\Http\Request;
use App\Models\MedicalDocuments;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Auth\RegisteredUserController;

class SeafarerController extends Controller
{

    public function index()
    {
        return Inertia::render(
            'User/PersonalDetails',
            [
                'roles' => Roles::all(),
                'user_name' => Auth()->user()->name,
                'user_email' => Auth()->user()->email
            ]
        );
    }


    /**
     * seafarer creation
     */
    public function store(Request $request)
    {
        $validated = $request->validate($this->validateSeafarer());
        if (auth()->user()->role != 'admin') {
            $validated['user_id'] = auth()->user()->id;
        } else {
            $user = \App\Models\User::create([
                'name' => $validated['fullname'],
                'email' => $validated['email'],
                'password' => Hash::make('password')
            ]);
            $validated['user_id'] = $user->id;
        }


        if ($request->file('profile')) {
            $file = uniqid() . $request->file('profile')->getClientOriginalName();
            $request->file('profile')->storeAs('public/images', $file);
            $validated['profile'] = $file;
        }
        $validated['sign_on'] = '2024-09-12';
        $validated['sign_off'] = '2024-09-12';
        $seafarer = Seafarer::create($validated);
        if ($seafarer) {
            return redirect(route('passport.index', $seafarer->id));
        } else {
            return 'something wrong';
        }
    }
    /**
     * Display the specified resource.
     */
    public function show($seafarer_id)
    {
        $data = $this->retrieveSeafarer($seafarer_id);

        return Inertia::render('Admin/Applicant/ApplicantDetail', [
            'applicant' => $data['seafarer'],
            'passport' => $data['passport'],
            'certificates' => $data['certificates'],
            'experiences' => $data['experiences'],

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
        return Inertia::render('Admin/Applicant/ApplicantList', [
            'applicants' => $applicants,
            'jobs' => $jobs

        ]);
    }
    protected function searchEmail($query, $search)
    {
        return $query->when($search, function ($query, $search) {
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
        return Inertia::render('Admin/Seafarer/SeafarerList', [
            'seafarers' => $seafarersData,
        ]);
    }
    /**
     * show seafarer detail with medical documents and bank account
     */
    public function showSeafarer($seafarer_id)
    {
        $data = $this->retrieveSeafarer($seafarer_id);
        return Inertia::render('Admin/Seafarer/SeafarerDetail', [
            'applicant' => $data['seafarer'],
            'passport' => $data['passport'],
            'certificates' => $data['certificates'],
            'experiences' => $data['experiences'],
            'payrolls' => $data['payrolls'],
            'medical_documents' => $data['medical_documents'],
            'bank_accounts' => $data['bank_accounts'],
            'leaves' => $data['leaves']

        ]);
    }

    /**
     * View pdf
     */
    public function viewpdf($seafarer_id)
    {
        $seafarer = Seafarer::find($seafarer_id);

        return Inertia('Admin/Applicant/ApplicantPdf', [
            'applicant' => $seafarer,
            'passport' => $seafarer->passport->first(),
            'certificates' => $seafarer->certificates,
            'experiences' => $seafarer->experiences,

        ]);
    }
    /**
     * Display profile on user page
     */
    public function profile($id)
    {
        $seafarer = Seafarer::where('user_id', $id)->first();
        if ($seafarer) {
            $data = $this->retrieveSeafarer($seafarer->id);

            return Inertia::render('User/Profile', [
                'applicant' => $data['seafarer'],
                'passport' => $data['passport'],
                'vessel' => $data['vessel'],
                'certificates' => $data['certificates'],
                'experiences' => $data['experiences'],
                'leaves' => $data['leaves'],
                'payrolls' => $data['payrolls']
            ]);

        } else {
            return Inertia::render('User/Profile')->with(['message' => 'You have not applied for any position yet!']);
        }
    }
    /**
     * Display pdf file
     */
    public function serveFile($file)
    {
        $path = storage_path('storage/images/' . $file); // Adjust path as needed

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path);
    }
    /**
     * retrieve a particular seafarer info
     */
    protected function retrieveSeafarer($id)
    {
        $seafarer = Seafarer::with('passport', 'experiences', 'vessel','payrolls','leaves')->find($id);
        if ($seafarer) {
            return [
                'seafarer' => $seafarer,
                'passport' => $seafarer->passport->first(),
                'certificates' => $seafarer->certificates,
                'experiences' => $seafarer->experiences,
                'vessel' => $seafarer->vessel,
                'payrolls' => $seafarer->payrolls,
                'leaves' => $seafarer->leaves,
                'medical_documents' => $seafarer->medical_documents,
                'bank_accounts' => $seafarer->bank_accounts
            ];
        }

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
                'vessel_id' => $request->vessel_id,
                'status' => 'on_boarding'
            ]);

            return redirect(route('applicants.list'));
        }
    }
    /**
     * Edit Remark
     */
    public function postRemark(Request $request){
        $seafarer = Seafarer::find($request->seafarer_id);
        $validated = $request->validate([
            'remark_type' => 'required',
            'comment' => 'required|string'
        ]);

        if($seafarer){
            $seafarer->update([
                'remark_type' => $validated['remark_type'],
                'comment' => $validated['comment']
            ]);

        }
        // dd('success');
        return redirect(route('seafarer.detail', $seafarer->id));

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
     * directs to seafarer create form
     */
    public function seafarerForm()
    {
        $roles = Roles::all();
        return Inertia::render('Admin/Seafarer/SeafarerCreateForm', [
            'roles' => $roles
        ]);
    }
    /**
     * Validation
     */
    protected function validateSeafarer()
    {
        return [
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
        ];
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
