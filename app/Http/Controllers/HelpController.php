<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HelpGroup;
use App\Models\HelpEntry;

class HelpController extends Controller
{
    public function publicFaq()
    {
        $categories = HelpGroup::with('helpEntries')->get();
        return view('faq.index', compact('categories'));
    }

    public function index()
    {
        $categories = HelpGroup::with('helpEntries')->get();
        return view('faq.manage', compact('categories'));
    }

    public function create()
    {
        return view('faq.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category' => 'required|string|max:255',
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);

        $group = HelpGroup::firstOrCreate(['name' => $data['category']]);
        $group->helpEntries()->create([
            'question' => $data['question'],
            'answer' => $data['answer'],
        ]);

        return redirect()->route('faq.index')->with('success', 'FAQ toegevoegd.');
    }

    public function destroy($id)
    {
        HelpEntry::destroy($id);
        return redirect()->route('faq.index')->with('success', 'FAQ verwijderd.');
    }
}
