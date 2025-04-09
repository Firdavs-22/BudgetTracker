<?php

namespace App\Models;

use App\GoalStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Goal extends Model
{
    protected $fillable = [
        'account_id',
        'title',
        'total_amount',
        'step_amount',
        'start_date',
        'step_count',
        'current_step',
        'current_amount',
        'status'
    ];

    protected $casts = [
        'total_amount' => 'decimal:4',
        'step_amount' => 'decimal:4',
        'current_amount' => 'decimal:4',
        'start_date' => 'date',
        'status' => GoalStatus::class
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}
