<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function index()
    {
        return view('groups.index', [
            'groups' => Auth::user()->groups
        ]);
    }

    public function show(Group $group)
    {
        return view('groups.show', compact('group'));
    }
}
