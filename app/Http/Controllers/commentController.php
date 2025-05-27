<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Toon alle comments (voor iedereen leesbaar).
     */
    public function index()
    {
        $comments = Comment::latest()->get();
        return view('comments.index', compact('comments'));
    }

    /**
     * Toon het formulier om een comment te bewerken (alleen voor admin).
     */
    public function edit(Comment $comment)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Alleen admins mogen comments bewerken.');
        }

        return view('comments.edit', compact('comment'));
    }

    /**
     * Update een comment (alleen voor admin).
     */
    public function update(Request $request, Comment $comment)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Alleen admins mogen comments bijwerken.');
        }

        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment->update([
            'content' => $request->content,
        ]);

        return redirect()->route('comments.index')->with('success', 'Comment bijgewerkt.');
    }

    /**
     * Verwijder een comment (alleen voor admin).
     */
    public function destroy(Comment $comment)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Alleen admins mogen comments verwijderen.');
        }

        $comment->delete();

        return redirect()->route('comments.index')->with('success', 'Comment verwijderd.');
    }
}
