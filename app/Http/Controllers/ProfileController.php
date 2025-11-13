<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('customer.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:50',
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        $user->update([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
        ]);

        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui!');
    }
}
