<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function create()
    {
        return view('user.contact');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string',
        ]);

        try {
            DB::table('contacts')->insert([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'] ?? null,
                'message' => $validatedData['message'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->route('contact.create')->with('success', 'Your message has been sent successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to send message. Please try again later.']);
        }
    }
}
