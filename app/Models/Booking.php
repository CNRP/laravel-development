<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'start_time',
        'finish_time',
        'comments',
        'client_email',
        'employee_id',
        'payment_status',
        'payment_intent_id',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_email', 'email');
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'employee_id');
    }


}
