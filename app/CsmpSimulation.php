<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CsmpSimulation extends Model
{
    protected $fillable = [
        'description', 'user_id', 'data'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}