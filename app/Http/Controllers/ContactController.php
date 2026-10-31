<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Show the contact page with the form
    public function create()
    {
        return view('contact');
    }

    // Save the message to the database
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|max:255',
            'email'   => 'required|email|max:255',
            'message' => 'required|min:10|max:1000',
        ]);

        ContactMessage::create($data);

        return redirect()->route('contact')
                         ->with('success', 'Thank you! Your message has been sent.');
    }

    // Admin only: read all messages
    public function index()
    {
        $messages = ContactMessage::latest()->get();
        return view('messages.index', compact('messages'));
    }
}
