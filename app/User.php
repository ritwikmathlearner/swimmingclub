<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function parent()
    {
        return $this->belongsTo(User::class);
    }

    public function children()
    {
        return $this->hasMany(User::class, 'parent_id');
    }

    public function squad()
    {
        return $this->hasOne(Squad::class, 'coach_id');
    }

    public function races()
    {
        return $this->belongsToMany(Race::class)->withPivot('points');
    }

    public function trainings()
    {
        return $this->hasMany(Training::class);
    }
}
