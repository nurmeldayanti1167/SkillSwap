<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::with(['offeredSkills', 'soughtSkills'])->findOrFail($id);
        $unreadNotifications = auth()->user()->unreadNotifications->count();
        
        return view('users.show', compact('user', 'unreadNotifications'));
    }
}
