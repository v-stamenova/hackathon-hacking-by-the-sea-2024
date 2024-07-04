<?php

use App\Events\MessageSent;
use App\Http\Controllers\GroupController;
use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/chat/{friend}', function (User $friend) {
        return view('chat', [
            'friend' => $friend
        ]);
    })->name('chat');

    Route::post('/messages/{friend}', function (User $friend) {
        $message = ChatMessage::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $friend->id,
            'text' => request()->input('message')
        ]);

        broadcast(new MessageSent($message));

        return $message;
    });

    Route::resource('/groups', GroupController::class);
});

