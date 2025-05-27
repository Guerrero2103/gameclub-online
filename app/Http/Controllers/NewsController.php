<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class NewsController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $newsItems = News::latest()->paginate(10);
        return view('news.index', compact('newsItems'));
    }

    public function show($id)
    {
        $news = News::findOrFail($id);
        return view('news.show', compact('news'));
    }

    public function create()
    {
        // dd(auth()->user()); // Removed debugging line
        $this->authorize('manage-news'); // Re-enabled authorization
        return view('news.add'); // Return the new view
    }

    public function store(Request $request)
    {
        $this->authorize('manage-news');
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'published_at' => 'required|date',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('news_images', 'public');
        }

        News::create($validated);

        return redirect()->route('news.index')->with('success', 'Nieuwsitem aangemaakt.');
    }

    public function edit(News $news)
    {
        $this->authorize('manage-news');
        return view('news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $this->authorize('manage-news');
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'published_at' => 'required|date',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
            $validated['image'] = $request->file('image')->store('news_images', 'public');
        }

        $news->update($validated);

        return redirect()->route('news.index')->with('success', 'Nieuwsitem bijgewerkt.');
    }

    public function destroy(News $news)
    {
        $this->authorize('manage-news');

        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }

        $news->delete();

        return redirect()->route('news.index')->with('success', 'Nieuwsitem verwijderd.');
    }
}
