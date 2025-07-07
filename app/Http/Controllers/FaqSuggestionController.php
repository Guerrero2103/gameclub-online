<?php

namespace App\Http\Controllers;

use App\Models\FaqSuggestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class FaqSuggestionController extends Controller
{
    use AuthorizesRequests;

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'explanation' => 'nullable|string|max:1000',
        ]);

        FaqSuggestion::create([
            'user_id' => Auth::id(),
            'question' => $request->question,
            'explanation' => $request->explanation,
        ]);

        return back()->with('success', 'Je vraag is voorgesteld aan de admins!');
    }

    public function index()
    {
        $this->authorize('manage-faq');
        $suggestions = FaqSuggestion::where('approved', false)->with('user')->get();
        return view('admin.faq_suggestions.index', compact('suggestions'));
    }

    public function approve(FaqSuggestion $suggestion)
    {
        $this->authorize('manage-faq');
        $suggestion->approved = true;
        $suggestion->save();
        return back()->with('success', 'Suggestie goedgekeurd!');
    }

    public function destroy(FaqSuggestion $suggestion)
    {
        $this->authorize('manage-faq');
        $suggestion->delete();
        return back()->with('success', 'Suggestie verwijderd.');
    }
} 