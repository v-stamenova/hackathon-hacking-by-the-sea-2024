<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'score'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function groups(): belongsToMany
    {
        return $this->belongsToMany(Group::class);
    }

    public function awards(): belongsToMany
    {
        return $this->belongsToMany(Award::class);
    }


    public function checkForAwards()
    {
        foreach (Award::all() as $award) {
            if (!$this->awards->contains($award)) {
                if ($award->type == 'score') {
                    if ($this->score >= $award->baseline) {
                        $this->awards()->attach($award);
                    }
                }
            }
        }
    }

    public function checkForGroupAwards($group)
    {
        foreach (Award::all() as $award) {
            if (!$this->awards->contains($award)) {
                if ($award->type == 'members') {
                    if ($group->users->count() <= $award->baseline) {
                        $this->awards()->attach($award);
                    }
                }
            }
        }
    }

    protected function defaultProfilePhotoUrl()
    {
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=2E1A34&background=D1E5CB';
    }
}
