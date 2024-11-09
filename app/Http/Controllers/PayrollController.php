<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Response;

class PayrollController extends Controller
{
    public function calculate(Request $request)
    {
        $validated = $request->validate([
            'seafarer_id' => 'required',
            'base_salary' => 'required',
            'bonus' => 'required',
            'overtime_pay' => 'required',
            'deduction' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);
        $gain_salary = $validated['base_salary'] + $validated['bonus'] + $validated['overtime_pay'];
        $total_salary = $gain_salary - $validated['deduction'];
        $validated['total_salary'] = $total_salary;
        $payroll = Payroll::create($validated);
        if ($payroll) {
            return redirect(route('seafarer.detail', $payroll->seafarer_id));
        } else {
            return response('Payroll calculation failed', 300);
        }
    }
    public function changeStatus($id)
    {
        $payroll = Payroll::find($id);
        if ($payroll && !$payroll->status) {
            $payroll->update([
                'status' => true,
                'payment_date' => Carbon::now()->toDate()
            ]);
            return redirect(route('seafarer.detail', $payroll->seafarer_id));
        }
    }
}
