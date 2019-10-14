<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'nama_kategori','agency_id'
    ];

    public function agency()
    {
        return $this->belongsTo("App\agency");
    }

    public function notulen()
    {
        return $this->hasMany("App\notulen");
    }
}


