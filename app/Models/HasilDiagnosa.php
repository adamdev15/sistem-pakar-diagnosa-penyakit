<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilDiagnosa extends Model
{
    protected $guarded = ['id'];

    public function diagnosa()
    {
        return $this->belongsTo(Diagnosa::class);
    }

    public function penyakit()
    {
        return $this->belongsTo(Penyakit::class);
    }
}
