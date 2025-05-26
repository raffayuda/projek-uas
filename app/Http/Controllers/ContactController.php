<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        try {
            Mail::raw(
                "Pesan dari: {$validated['name']} <{$validated['email']}>

Subjek: {$validated['subject']}

Pesan:
{$validated['message']}",
                function ($mail) use ($validated) {
                    $mail->to('rafffa0206@gmail.com')
                        ->subject('[Contact Form] ' . $validated['subject']);
                }
            );
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Contact form failed: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Failed to send email.'], 500);
        }
    }
}
