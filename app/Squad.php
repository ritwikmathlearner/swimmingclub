<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Squad extends Model
{
    protected $guarded = [];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function coach()
    {
        return $this->hasOne(User::class);
    }
}
