<?php

namespace App\Models\Dto;

use App\Models\Enums\Operation;
use Spatie\LaravelData\Data;

class TransactionData extends Data
{
    public function __construct(
        public readonly string $amount,
        /**
         * @Data
         * automatically casts this value to its enum representation.
         * If it's an invalid enum case, an error gets thrown,
         * If an invalid value is given from the request, the package
         * will automatically convert the error into a ValidationException
         */
        public readonly Operation $operation,
    ) {}
}
