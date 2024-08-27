<?php

namespace App\Http\Controllers;

use App\Models\BankAccounts;
use Illuminate\Http\Request;

class BankAccountsController extends Controller
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
            'account_no'=> 'required|min:13|unique:bank_accounts,account_no,except,id',
            'bank_branch'=> 'required',
            'account_holder'=> 'required',
            'holder_phone'=> 'required',
        ]);

        $account = BankAccounts::create($validated);
        return redirect()->route('seafarer.detail', $account->seafarer_id)->with('message','Bank Account Added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(BankAccounts $bankAccounts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BankAccounts $bankAccounts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BankAccounts $bankAccounts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BankAccounts $bankAccounts)
    {
        //
    }
}
