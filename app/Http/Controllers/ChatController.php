<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('chats.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('chats.chat', compact('user'));
    }
}
