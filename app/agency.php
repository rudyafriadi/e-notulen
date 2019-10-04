<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class agency extends Model
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
}
