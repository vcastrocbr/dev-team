<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Music extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'artist', 'genre', 'file_path'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'music_tag');
    }
        
}
