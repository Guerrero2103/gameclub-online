<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Toon het contactformulier.
     */
    public function create()
    {
        return view('contact.create');
    }

    /**
     * Verwerk het verzonden contactformulier.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'message' => 'required|string|max:2000',
        ]);

        try {
            Mail::raw($validated['message'], function ($mail) use ($validated) {
                $mail->to('admin@ehb.be')
                    ->subject('Nieuw bericht via contactformulier van ' . $validated['name'])
                    ->replyTo($validated['email']);
            });

            return back()->with('success', 'Je bericht is succesvol verzonden!');

        } catch (\Exception $e) {
            return back()->withErrors('Er ging iets mis bij het verzenden. Probeer opnieuw later.');
        }
    }
}
