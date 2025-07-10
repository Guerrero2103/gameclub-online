<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Forum;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    public function index()
    {
        $forums = Forum::with('user')->latest()->paginate(10);
        return view('forum.index', compact('forums'));
    }

    public function show($id)
    {
        $forum = Forum::with(['user', 'forumReplies.user'])->findOrFail($id);
        return view('forum.show', compact('forum'));
    }

    public function create()
    {
        return view('forum.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);
        $data['user_id'] = Auth::id();
        $forum = Forum::create($data);
        return redirect()->route('forum.show', $forum->id)->with('success', 'Topic aangemaakt!');
    }
}
