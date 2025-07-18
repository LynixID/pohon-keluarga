<?php

namespace App\Http\Controllers;

use App\Models\Family;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FamilyController extends Controller
{
    public function index()
    {
        $family = Auth::user()->family;
        return view('family.index', compact('family'));
    }

    public function create()
    {
        // Hanya user yang belum punya keluarga
        if (Auth::user()->family) {
            return redirect()->route('family.index')->with('error', 'Anda sudah memiliki keluarga.');
        }
        return view('family.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'family_name' => 'required|string|max:255|unique:families,family_name,NULL,id,user_id,' . Auth::id(),
            'description' => 'nullable|string',
        ]);

        if (Auth::user()->family) {
            return redirect()->route('family.index')->with('error', 'Anda sudah memiliki keluarga.');
        }

        $family = Family::create([
            'user_id' => Auth::id(),
            'family_name' => $request->family_name,
            'description' => $request->description,
        ]);

        return redirect()->route('family.index')->with('success', 'Keluarga berhasil dibuat!');
    }

    public function edit(Family $family)
    {
        // Hanya user yang punya keluarga ini
        if ($family->user_id !== Auth::id()) {
            abort(403);
        }
        return view('family.edit', compact('family'));
    }

    public function update(Request $request, Family $family)
    {
        if ($family->user_id !== Auth::id()) {
            abort(403);
        }
        $request->validate([
            'family_name' => 'required|string|max:255|unique:families,family_name,' . $family->id . ',id,user_id,' . Auth::id(),
            'description' => 'nullable|string',
        ]);
        $family->update($request->only('family_name', 'description'));
        return redirect()->route('family.index')->with('success', 'Keluarga berhasil diupdate!');
    }

    public function destroy(Family $family)
    {
        if ($family->user_id !== Auth::id()) {
            abort(403);
        }
        $family->delete();
        return redirect()->route('family.index')->with('success', 'Keluarga berhasil dihapus.');
    }
}
