<?php

namespace App\Models\Values;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Spatie\LaravelData\Data;
use Symfony\Component\Mime\Address;

class EmailData extends Data
{
    public function __construct(
        public readonly Address $email
    ) {}

    public static function castUsing(array $arguments)
    {
        return new class implements CastsAttributes {
            public function get($model, string $key, $value, array $attributes)
            {
                $result = $value instanceof Address ? $value : new Address($value, "{$model->name} <{$value}>");

                return new EmailData($result);
            }

            public function set($model, string $key, $value, array $attributes)
            {
                if ($value instanceof Address) {
                    return $value->getAddress();
                }

                return $value;
            }
        };
    }
}
