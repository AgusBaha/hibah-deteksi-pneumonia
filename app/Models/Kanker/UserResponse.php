<?php

namespace App\Models\Kanker;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserResponse extends Model
{
    use HasFactory;

    protected $fillable = ['question_id', 'question_type', 'response', 'weight'];
}
