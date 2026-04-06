<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Profile;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:100',
            'subject' => 'required|string|max:200',
            'message' => 'required|string|max:2000',
        ]);

        Contact::create(array_merge($validated, [
            'ip_address' => $request->ip(),
        ]));

        return back()->with('success', 'Pesan Anda berhasil dikirim! Saya akan segera membalas.');
    }
}
