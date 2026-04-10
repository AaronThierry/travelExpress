<?php

namespace App\Models\YuanFlow;

use Illuminate\Database\Eloquent\Model;

class YfNotification extends Model
{
    protected $table = 'yf_notifications';

    protected $fillable = [
        'yf_user_id', 'type', 'title', 'message', 'data', 'read_at',
    ];

    protected $casts = [
        'data'    => 'array',
        'read_at' => 'datetime',
    ];

    public function yfUser()
    {
        return $this->belongsTo(YfUser::class, 'yf_user_id');
    }

    public function markAsRead(): void
    {
        $this->update(['read_at' => now()]);
    }
}
