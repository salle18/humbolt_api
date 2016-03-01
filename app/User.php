<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements AuthenticatableContract
{
    use Authenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public function csmpsimulations()
    {
        return $this->hasMany(CsmpSimulation::class);
    }

    public function gpsssimulations()
    {
        return $this->hasMany(GpssSimulation::class);
    }
}
