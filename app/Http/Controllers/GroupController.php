<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Auth::user()->groups;

        return view('room.index', compact('groups'));
    }

    public function create()
    {
        return view('room.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'topic' => 'required|string',
            'goal' => 'required|string',
            'user_emails' => ''
        ]);

        $response = Http::post('http://localhost:3000/session', [
            'topic' => $validatedData['topic'],
            'goal' => $validatedData['goal'],
        ]);

        if ($response->successful()) {
            $responseData = $response->json();

            $group = Group::create([
                'topic' => $validatedData['topic'],
                'goal' => $validatedData['goal'],
                'url' => $responseData['url']
            ]);
        } else {
            return response()->json([
                'message' => 'Failed to create session.',
                'details' => $response->body(),
            ], $response->status());
        }

        $emailArray = json_decode($validatedData['user_emails'], true);

        if ($emailArray) {
            foreach ($emailArray as $email) {
                $user = User::where('email', $email)->first();
                if ($user) {
                    $group->users()->attach($user);
                }
            }
        }

        $group->users()->attach(Auth::user());


        return redirect(route('groups.show', $group));
    }

    public function show(Group $group)
    {
        return view('room.view', compact('group'));
    }
}
