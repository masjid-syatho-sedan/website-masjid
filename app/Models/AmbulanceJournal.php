<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class AmbulanceJournal extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'tasks',
        'images',
        'videos',
        'links',
        'journal_date',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'tasks' => 'array',
            'images' => 'array',
            'videos' => 'array',
            'links' => 'array',
            'journal_date' => 'date',
        ];
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected static function booted(): void
    {
        static::creating(function (AmbulanceJournal $journal) {
            if (empty($journal->{$journal->getKeyName()})) {
                $journal->{$journal->getKeyName()} = self::generateShortId();
            }
        });

        // Hapus file yang dihapus dari form saat edit
        static::saving(function (AmbulanceJournal $journal) {
            foreach (['images', 'videos'] as $field) {
                $old = $journal->getOriginal($field) ?? [];
                $new = $journal->$field ?? [];
                $removed = array_diff($old, $new);
                foreach ($removed as $file) {
                    Storage::disk('public')->delete($file);
                }
            }
        });

        // Hapus semua file saat record dihapus
        static::deleting(function (AmbulanceJournal $journal) {
            foreach (['images', 'videos'] as $field) {
                foreach ($journal->$field ?? [] as $file) {
                    Storage::disk('public')->delete($file);
                }
            }
        });
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }

    // Karakter yang dipakai untuk ID pendek — hindari 0/O dan 1/I/L yang mirip
    private const SHORT_ID_CHARS = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';

    public static function generateShortId(): string
    {
        $chars = self::SHORT_ID_CHARS;
        $result = '';
        for ($i = 0; $i < 5; $i++) {
            $result .= $chars[random_int(0, strlen($chars) - 1)];
        }

        return $result;
    }
}
