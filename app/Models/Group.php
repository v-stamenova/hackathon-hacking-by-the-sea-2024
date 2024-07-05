<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['topic', 'goal', 'url'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(GroupMessage::class);
    }

    public function lastUsed()
    {
        $messages = $this->messages()
            ->orderBy('created_at', 'asc')
            ->get();

        $lastMessage = $this->messages->last();
        if (is_null($lastMessage)) {
            return $this->created_at;
        }
        return $lastMessage->created_at;
    }
}
