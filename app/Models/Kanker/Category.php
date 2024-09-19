<?php

namespace App\Models\Kanker;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'descriptions'];

    public function mainQuestions()
    {
        return $this->hasMany(MainQuestion::class);
    }
}
