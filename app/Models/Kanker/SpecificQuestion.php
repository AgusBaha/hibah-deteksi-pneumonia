<?php

namespace App\Models\Kanker;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecificQuestion extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'question', 'weight'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
