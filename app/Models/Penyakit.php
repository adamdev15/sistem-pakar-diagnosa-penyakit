<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penyakit extends Model
{
    protected $guarded = ['id'];

    public function aturans()
    {
        return $this->hasMany(Aturan::class);
    }
}
