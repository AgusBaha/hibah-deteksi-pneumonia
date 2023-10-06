<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasisKasus extends Model
{
    use HasFactory;

    protected $table = 'basis_kasus';
    protected $guarded = [];

    public function gejala()
    {
        return $this->belongsToMany(gejala::class, 'basis_kasus_gejala'); // Jika Anda memiliki kolom tambahan dalam tabel pivot
    }
}
