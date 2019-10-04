<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    protected $fillable = [
       'name','nip','instansi', 'username', 'password', 'role'
    ];

    public function notulen()
    {
        return $this->hasMany(Notulen::class);
        // return $this->hasMany('App\Notulen', 'users_id', 'id');
    }
}

