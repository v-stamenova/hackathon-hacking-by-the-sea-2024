<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Group extends Model
{
    use HasFactory;
    protected $fillable = ['topic', 'goal', 'url'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
