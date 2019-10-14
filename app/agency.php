<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    protected $fillable = [
        'nama_instansi',
    ];

    public function user()
    {
        return $this->hasMany("App\User");
    }

    public function notulen()
    {
        return $this->hasMany("App\Notulen");
    }

    public function category()
    {
        return $this->hasMany("App\category");
    }
}
