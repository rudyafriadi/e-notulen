<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notulen extends Model
{
    protected $fillable = [
        'agenda_rapat','category_id','agency_id','user_id','tanggal','hari','status','file',
    ];

    public function agency()
    {
        return $this->belongsTo("App\agency");
    }

    public function category()
    {
        return $this->belongsTo("App\category");
    }

    public function user()
    {
        return $this->belongsTo("App\user");
    }
}
