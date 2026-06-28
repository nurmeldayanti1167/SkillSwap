<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\UserSkill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserSkillController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'skill_id' => ['required', 'exists:skills,id'],
            'type' => ['required', 'in:offer,seek'],
            'proficiency_level' => ['required', 'in:beginner,intermediate,expert'],
        ]);

        $exists = UserSkill::where('user_id', Auth::id())
            ->where('skill_id', $request->skill_id)
            ->where('type', $request->type)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Skill sudah ditambahkan!');
        }

        UserSkill::create([
            'user_id' => Auth::id(),
            'skill_id' => $request->skill_id,
            'type' => $request->type,
            'proficiency_level' => $request->proficiency_level,
        ]);

        return back()->with('success', 'Skill berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $userSkill = UserSkill::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $userSkill->delete();

        return back()->with('success', 'Skill berhasil dihapus!');
    }
}
