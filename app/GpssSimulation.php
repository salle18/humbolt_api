<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GpssSimulation extends Model
{
    protected $fillable = [
        'description', 'data',
    ];

    protected $guarded = [
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}