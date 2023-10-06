<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gejala extends Model
{
    use HasFactory;

    protected $table = 'gejala';
    protected $guarded = [];

    public function basisKasus()
    {
        return $this->belongsToMany(BasisKasus::class, 'basis_kasus_gejala'); // Jika Anda memiliki kolom tambahan dalam tabel pivot
    }
}
