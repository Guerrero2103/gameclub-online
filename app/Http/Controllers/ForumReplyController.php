<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ForumReply;
use Illuminate\Support\Facades\Auth;

class ForumReplyController extends Controller
{
    public function store(Request $request, $forum_id)
    {
        $data = $request->validate([
            'body' => 'required|string',
        ]);
        $data['forum_id'] = $forum_id;
        $data['user_id'] = Auth::id();
        ForumReply::create($data);
        return redirect()->route('forum.show', $forum_id)->with('success', 'Reactie geplaatst!');
    }
}
