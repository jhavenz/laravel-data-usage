<?php

namespace App\Models\Dto;

use App\Models\User;
use App\Models\Values\EmailData;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\CamelCaseMapper;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[
    // @Data
    // Any property implementing DateTimeInterface (within the type-hint)
    // will automatically be cast to a CarbonImmutable
    WithCast(DateTimeInterfaceCast::class, type: CarbonImmutable::class),

    // @Data
    // This tells the package to convert all incoming properties to snakeCase prior to creating an instance
    // (especially useful when the data source is a db an the columns are snake case)
    MapInputName(CamelCaseMapper::class)
]
class UserData extends Data
{
    public function __construct(
        public readonly string $name,
        public readonly EmailData $email,
        public readonly string $password,
        public readonly ?string $rememberToken = null,
        public readonly ?CarbonImmutable $updatedAt = null,
        public readonly ?CarbonImmutable $createdAt = null,
        public readonly ?CarbonImmutable $emailVerifiedAt = null,
    ) {}

    /**
     * @Data
     * Use this approach if you need to run some custom logic
     * when a dto is being created (based on what's being passed in)
     *
     * This method automatically gets called when doing:
     * `UserData::from(new User(...))`
     *
     * The package knows about any static from* methods on this class,
     * then calls the appropriate one based on the type(s) being given.
     * More examples are:
     * `UserData::fromRequest(request())`
     * or
     * `UserData::fromArray([...])`
     */
    public static function fromUser(User $user): static
    {
        // this would typically be in the AppServiceProvider
        // tells laravel to use immutable carbon instances
        // when casting properties, calling `now()`, etc.
        Date::useClass(CarbonImmutable::class);

        return new static(
            $user->name,
            $user->email,
            $user->getAuthPassword(),
            $user->getRememberToken(),
            // These 3 get cast to Carbon automatically by laravel
            $user->updated_at,
            $user->created_at,
            $user->email_verified_at
        );
    }
}
