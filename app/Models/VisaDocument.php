<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class VisaDocument extends Model
{
    protected $fillable = [
        'visa_application_id',
        'document_type',
        'file_path',
        'original_filename',
        'file_size',
        'mime_type',
        'status',
        'rejection_reason',
        'reviewed_by',
        'reviewed_at',
    ];

    protected $casts = [
        'reviewed_at' => 'datetime',
    ];

    // ─── Relationships ────────────────────────────────────────────────────────

    public function visaApplication()
    {
        return $this->belongsTo(VisaApplication::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    // ─── Auto-delete file ─────────────────────────────────────────────────────

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($document) {
            Storage::disk('private')->delete($document->file_path);
        });
    }

    // ─── Computed attributes ──────────────────────────────────────────────────

    public function getFileSizeHumanAttribute(): string
    {
        $bytes = $this->file_size;
        $units = ['o', 'Ko', 'Mo', 'Go'];
        $pow   = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow   = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);
        return round($bytes, 1) . ' ' . $units[$pow];
    }
}
