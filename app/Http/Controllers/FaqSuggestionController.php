<?php

namespace App\Http\Controllers;

use App\Models\FaqSuggestion;
use App\Models\HelpEntry;
use App\Models\HelpGroup;
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
        
        try {
            // Mark the suggestion as approved
            $suggestion->approved = true;
            $suggestion->save();
            
            // Create a new FAQ entry from the suggestion
            // First, get or create a default category for approved suggestions
            $defaultCategory = HelpGroup::firstOrCreate(
                ['name' => 'Algemeen'],
                ['name' => 'Algemeen']
            );
            
            // Create the FAQ entry
            HelpEntry::create([
                'help_group_id' => $defaultCategory->id,
                'question' => $suggestion->question,
                'answer' => $suggestion->explanation ?: 'Deze vraag is goedgekeurd door een admin.',
            ]);
            
            return back()->with('success', 'Suggestie goedgekeurd en FAQ toegevoegd!');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error approving FAQ suggestion:', ['error' => $e->getMessage()]);
            return back()->with('error', 'Er is een fout opgetreden bij het goedkeuren van de suggestie.');
        }
    }

    public function destroy(FaqSuggestion $suggestion)
    {
        $this->authorize('manage-faq');
        $suggestion->delete();
        return back()->with('success', 'Suggestie verwijderd.');
    }
} 