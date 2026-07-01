<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Skill;
use App\Models\Swap;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'users' => User::count(),
            'skills' => Skill::count(),
            'swaps' => Swap::count(),
        ];
        return view('admin.dashboard', compact('stats'));
    }

    public function users()
    {
        $users = User::paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function update(User $user)
    {
        $user->role = $user->role === 'admin' ? 'user' : 'admin';
        $user->save();
        return redirect()->route('admin.users')->with('success', 'User role updated.');
    }
}