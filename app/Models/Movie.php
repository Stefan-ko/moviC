<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'title_uk',
        'title_en',
        'description_uk',
        'description_en',
        'poster',
        'screenshots',
        'youtube_trailer_id',
        'release_year',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'status' => 'boolean',
        'screenshots' => 'array',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function casts()
    {
        return $this->hasMany(Cast::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

}
