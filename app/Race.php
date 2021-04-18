<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('points');
    }
}
