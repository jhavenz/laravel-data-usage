<?php

namespace App\Models;

use App\Models\Dto\TransactionData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\LaravelData\WithData;

class Transaction extends Model
{
    use HasFactory;
    use WithData;

    public string $dataClass = TransactionData::class;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
