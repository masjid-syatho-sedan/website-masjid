<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    /** @use HasFactory<\Database\Factories\TagFactory> */
    use HasFactory;

    protected $fillable = [
        'nama',
        'slug',
    ];

    public function artikels(): BelongsToMany
    {
        return $this->belongsToMany(Artikel::class, 'artikel_tag');
    }
}
