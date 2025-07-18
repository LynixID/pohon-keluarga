<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\FamilyMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FamilyMemberController extends Controller
{
    public function index(Family $family)
    {
        if ($family->user_id !== Auth::id()) {
            abort(403);
        }
        $members = $family->members;
        return view('family_members.index', compact('family', 'members'));
    }

    public function create(Family $family)
    {
        if ($family->user_id !== Auth::id()) {
            abort(403);
        }
        return view('family_members.create', compact('family'));
    }

    public function store(Request $request, Family $family)
    {
        if ($family->user_id !== Auth::id()) {
            abort(403);
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'relation' => 'required|string|max:100',
            'gender' => 'required|in:L,P',
            'birth_date' => 'nullable|date',
        ]);
        $family->members()->create($request->only('name', 'relation', 'gender', 'birth_date'));
        return redirect()->route('family.members.index', $family)->with('success', 'Anggota keluarga berhasil ditambahkan!');
    }

    public function edit(Family $family, FamilyMember $member)
    {
        if ($family->user_id !== Auth::id() || $member->family_id !== $family->id) {
            abort(403);
        }
        return view('family_members.edit', compact('family', 'member'));
    }

    public function update(Request $request, Family $family, FamilyMember $member)
    {
        if ($family->user_id !== Auth::id() || $member->family_id !== $family->id) {
            abort(403);
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'relation' => 'required|string|max:100',
            'gender' => 'required|in:L,P',
            'birth_date' => 'nullable|date',
        ]);
        $member->update($request->only('name', 'relation', 'gender', 'birth_date'));
        return redirect()->route('family.members.index', $family)->with('success', 'Anggota keluarga berhasil diupdate!');
    }

    public function destroy(Family $family, FamilyMember $member)
    {
        if ($family->user_id !== Auth::id() || $member->family_id !== $family->id) {
            abort(403);
        }
        $member->delete();
        return redirect()->route('family.members.index', $family)->with('success', 'Anggota keluarga berhasil dihapus!');
    }
}
