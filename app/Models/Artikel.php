<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Artikel extends Model
{
    /** @use HasFactory<\Database\Factories\ArtikelFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kategori_id',
        'judul',
        'slug',
        'ringkasan',
        'konten',
        'gambar',
        'status',
        'unggulan',
        'dilihat',
        'diterbitkan_pada',
    ];

    protected function casts(): array
    {
        return [
            'unggulan' => 'boolean',
            'dilihat' => 'integer',
            'diterbitkan_pada' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'artikel_tag');
    }

    /**
     * Scope untuk artikel yang sudah diterbitkan.
     */
    public function scopeDiterbitkan(Builder $query): Builder
    {
        return $query->where('status', 'diterbitkan')
            ->whereNotNull('diterbitkan_pada')
            ->where('diterbitkan_pada', '<=', now());
    }

    /**
     * Scope untuk artikel unggulan.
     */
    public function scopeUnggulan(Builder $query): Builder
    {
        return $query->where('unggulan', true);
    }
}
