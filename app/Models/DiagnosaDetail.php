<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiagnosaDetail extends Model
{
    protected $guarded = ['id'];

    public function diagnosa()
    {
        return $this->belongsTo(Diagnosa::class);
    }

    public function gejala()
    {
        return $this->belongsTo(Gejala::class);
    }
}
