<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategori extends Model
{
    /** @use HasFactory<\Database\Factories\KategoriFactory> */
    use HasFactory;

    protected $fillable = [
        'nama',
        'slug',
        'deskripsi',
        'warna',
    ];

    public function artikels(): HasMany
    {
        return $this->hasMany(Artikel::class);
    }
}
