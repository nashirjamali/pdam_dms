<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    public function user()
    {
        return $this->belongsTo(User);
    }
}
