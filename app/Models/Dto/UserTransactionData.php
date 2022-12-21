<?php

namespace App\Models\Dto;

use App\Models\Transaction;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Concerns\TransformableData;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Tests\Models\Dto\UserTransactionDataTest;

class UserTransactionData extends Data
{
    public function __construct(
        public readonly string $userEmail,
        /**
         * @Data
         * This will automatically cast an array of transactions
         * {@see UserTransactionDataTest}
         */
        #[DataCollectionOf(TransactionData::class)]
        public readonly DataCollection $transactions,
    ) {}
}
