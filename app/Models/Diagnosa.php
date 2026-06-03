<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diagnosa extends Model
{
    protected $guarded = ['id'];

    public function details()
    {
        return $this->hasMany(DiagnosaDetail::class);
    }

    public function hasil_diagnosas()
    {
        return $this->hasMany(HasilDiagnosa::class);
    }

    public function hasil_penyakit()
    {
        return $this->belongsTo(Penyakit::class, 'hasil_penyakit_id');
    }
}
