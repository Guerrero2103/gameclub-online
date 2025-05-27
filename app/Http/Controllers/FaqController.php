<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HelpEntry;

class FaqController extends Controller
{
    public function index()
    {
        $entries = HelpEntry::with('group')->get();
        return view('faq.index', compact('entries'));
    }
}

