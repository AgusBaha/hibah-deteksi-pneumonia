<?php

namespace App\Models\Kanker;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserResponse extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'respondent_count', 'yes_count', 'no_count'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
