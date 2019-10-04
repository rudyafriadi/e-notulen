<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notulen extends Model
{
    protected $fillable = [
        'agenda_rapat','j_rapat','instansi','users_id','tanggal','hari','status','file',
    ];

    public function agency()
    {
        return $this->belongsTo("App\agency");
    }
}
