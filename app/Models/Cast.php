<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cast extends Model
{
    use HasFactory;

    protected $table = 'cast';

    protected $fillable = [
        'movie_id',
        'role',
        'name_uk',
        'name_en',
        'photo',
    ];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
