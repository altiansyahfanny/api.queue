<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service_id',
        'queue_status_id',
        'date',
        'when'
    ];

    public function queue_status()
    {
        return $this->belongsTo(QueueStatus::class);
    }
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
