<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class GeneralJournal extends Model
{
    use HasFactory, HasUuids;

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

    protected static function booted(): void
    {
        static::saving(function (GeneralJournal $journal) {
            foreach (['images', 'videos'] as $field) {
                $old = $journal->getOriginal($field) ?? [];
                $new = $journal->$field ?? [];
                $removed = array_diff($old, $new);
                foreach ($removed as $file) {
                    Storage::disk('public')->delete($file);
                }
            }
        });

        static::deleting(function (GeneralJournal $journal) {
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
}
