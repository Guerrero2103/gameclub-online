<?php

namespace App\Http\Controllers;

use App\Models\GameBuzz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GameBuzzController extends Controller
{
    public function index()
    {
        $news = GameBuzz::orderBy('published_at', 'desc')->get();
        return view('news.index', compact('news'));
    }

    public function show($id)
    {
        $item = GameBuzz::findOrFail($id);
        return view('news.show', compact('item'));
    }

    public function create()
    {
        return view('game_buzz.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'published_at' => 'required|date',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('news_images', 'public');
        }

        GameBuzz::create($data);
        return redirect()->route('news.index')->with('success', 'Nieuwsitem toegevoegd');
    }

    public function edit($id)
    {
        $item = GameBuzz::findOrFail($id);
        return view('game_buzz.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = GameBuzz::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'published_at' => 'required|date',
        ]);

        if ($request->hasFile('image')) {
            if ($item->image) {
                Storage::disk('public')->delete($item->image);
            }
            $data['image'] = $request->file('image')->store('news_images', 'public');
        }

        $item->update($data);
        return redirect()->route('news.index')->with('success', 'Nieuwsitem bijgewerkt');
    }

    public function destroy($id)
    {
        $item = GameBuzz::findOrFail($id);
        if ($item->image) {
            Storage::disk('public')->delete($item->image);
        }
        $item->delete();
        return redirect()->route('news.index')->with('success', 'Nieuwsitem verwijderd');
    }
}
