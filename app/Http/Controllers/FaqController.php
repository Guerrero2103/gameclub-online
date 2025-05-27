<?php

namespace App\Http\Controllers;

use App\Models\HelpEntry;
use App\Models\HelpGroup;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Log;

class FaqController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $categories = HelpGroup::with('helpEntries')->get();
        return view('faq.index', compact('categories'));
    }

    public function manage()
    {
        $this->authorize('manage-faq');
        $categories = HelpGroup::with('helpEntries')->get();
        return view('faq.manage', compact('categories'));
    }

    public function create()
    {
        $this->authorize('manage-faq');
        $categories = HelpGroup::all();
        \Illuminate\Support\Facades\Log::info('FAQ Categories in create method:', ['categories' => $categories]);
        return view('faq.form', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->authorize('manage-faq');
        
        \Illuminate\Support\Facades\Log::info('FAQ Store received data BEFORE validation:', ['data' => $request->all()]);

        $data = $request->validate([
            'category' => 'required',
            'newCategory' => 'nullable|required_if:category,new|string|max:255|unique:help_groups,name',
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ], [
            'category.required' => 'Selecteer een categorie of kies voor een nieuwe categorie.',
            'newCategory.required_if' => 'Vul een naam in voor de nieuwe categorie.',
            'newCategory.unique' => 'Deze categorie bestaat al.',
            'question.required' => 'De vraag is verplicht.',
            'answer.required' => 'Het antwoord is verplicht.',
        ]);

        try {
            if ($data['category'] === 'new') {
                $group = HelpGroup::create(['name' => $data['newCategory']]);
                \Illuminate\Support\Facades\Log::info('New HelpGroup created:', ['group' => $group]);
            } else {
                $group = HelpGroup::findOrFail($data['category']);
                \Illuminate\Support\Facades\Log::info('Existing HelpGroup found:', ['group' => $group]);
            }

            $faqEntry = $group->helpEntries()->create([
                'question' => $data['question'],
                'answer' => $data['answer'],
            ]);
            \Illuminate\Support\Facades\Log::info('New HelpEntry created:', ['faqEntry' => $faqEntry]);

            return redirect()->route('faq.manage')->with('success', 'FAQ succesvol toegevoegd.');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error creating FAQ:', ['error' => $e->getMessage()]);
            return back()->withInput()->with('error', 'Er is een fout opgetreden bij het toevoegen van de FAQ.');
        }
    }

    public function edit(HelpEntry $faq)
    {
        $this->authorize('manage-faq');
        $categories = HelpGroup::all();
        return view('faq.form', compact('faq', 'categories'));
    }

    public function update(Request $request, HelpEntry $faq)
    {
        $this->authorize('manage-faq');
        
        $data = $request->validate([
            'category' => 'required',
            'newCategory' => 'nullable|required_if:category,new|string|max:255|unique:help_groups,name',
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ], [
            'category.required' => 'Selecteer een categorie of kies voor een nieuwe categorie.',
            'newCategory.required_if' => 'Vul een naam in voor de nieuwe categorie.',
            'newCategory.unique' => 'Deze categorie bestaat al.',
            'question.required' => 'De vraag is verplicht.',
            'answer.required' => 'Het antwoord is verplicht.',
        ]);

        try {
            if ($data['category'] === 'new') {
                $group = HelpGroup::create(['name' => $data['newCategory']]);
            } else {
                $group = HelpGroup::findOrFail($data['category']);
            }

            $faq->update([
                'help_group_id' => $group->id,
                'question' => $data['question'],
                'answer' => $data['answer'],
            ]);

            return redirect()->route('faq.manage')->with('success', 'FAQ succesvol bijgewerkt.');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error updating FAQ:', ['error' => $e->getMessage()]);
            return back()->withInput()->with('error', 'Er is een fout opgetreden bij het bijwerken van de FAQ.');
        }
    }

    public function destroy(HelpEntry $faq)
    {
        $this->authorize('manage-faq');
        $faq->delete();
        return redirect()->route('faq.manage')->with('success', 'FAQ succesvol verwijderd.');
    }

    // Method to delete an FAQ category and its related entries
    public function destroyCategory(HelpGroup $category)
    {
        $this->authorize('manage-faq');

        try {
            // Delete all related FAQ entries first
            $category->helpEntries()->delete();

            // Then delete the category
            $category->delete();

            return redirect()->route('faq.manage')->with('success', 'Categorie succesvol verwijderd.');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error deleting FAQ category:', ['error' => $e->getMessage()]);
            return back()->with('error', 'Er is een fout opgetreden bij het verwijderen van de categorie.');
        }
    }
}

