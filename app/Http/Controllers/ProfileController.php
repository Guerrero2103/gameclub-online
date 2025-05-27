<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();

        // Maak een lege spelerkaart aan indien deze nog niet bestaat
        $profile = $user->playerCard;
        if (!$profile) {
            $profile = $user->playerCard()->create([
                'user_id' => $user->id,
                'username' => '',
                'birthday' => null,
                'about' => '',
                'profile_picture' => null,
            ]);
        }

        return view('profile.edit', compact('user', 'profile'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $profile = $user->playerCard;

        if (!$profile) {
            abort(404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'birthday' => 'nullable|date',
            'about' => 'nullable|string',
            'profile_picture' => 'nullable|image|max:2048',
        ]);

        // ✅ Update naam van gebruiker
        $user->name = $validated['name'];
        $user->save();

        // ✅ Update profiel (zonder 'name')
        $profileData = $validated;
        unset($profileData['name']);

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $profileData['profile_picture'] = $path;
        }

        $profile->update($profileData);

        return redirect()->back()->with('success', 'Profiel succesvol bijgewerkt.');
    }
}
