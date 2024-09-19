<?php

namespace App\Models\Kanker;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecificQuestion extends Model
{
    use HasFactory;

    protected $fillable = ['main_question_id', 'question', 'weight'];

    public function mainQuestion()
    {
        return $this->belongsTo(MainQuestion::class);
    }
}
