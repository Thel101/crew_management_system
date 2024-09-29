<?php

namespace App\Http\Controllers;

use App\Mail\SendCV;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail(Request $request){
        $request->validate([
            'email' => 'required',
            'body' => 'required',
            'file' => 'required|file'
        ]);
        Mail::to($request->email)->send(new SendCV($request->body, $request->file('file')));
    }
}
