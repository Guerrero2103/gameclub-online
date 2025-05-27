<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlayerCard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PlayerCardController extends Controller
{
    public function edit()
    {
        $user = Auth::user();

        // Zorg dat playerCard bestaat
        if (!$user->playerCard) {
            $user->playerCard()->create();
        }

        $profile = $user->playerCard;

        return view('profile.edit', [
            'profile' => $profile,
            'user' => $user
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'username' => 'nullable|string|max:255',
            'birthday' => 'nullable|date',
            'profile_picture' => 'nullable|image|max:2048',
            'about' => 'nullable|string',
        ]);

        $profile = Auth::user()->playerCard;

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profiles', 'public');
            $data['profile_picture'] = $path;
        }

        $profile->update($data);

        return back()->with('success', 'Profiel bijgewerkt.');
    }

    public function show($id)
    {
        $profile = PlayerCard::where('user_id', $id)->firstOrFail();
        return view('profile.show', compact('profile'));
    }

    public function destroy()
    {
        $user = auth()->user();

        if ($user->playerCard) {
            $user->playerCard()->delete();
        }

        $user->delete();

        return redirect('/')->with('success', 'Account verwijderd.');
    }
}
