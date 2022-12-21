<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Dto\UserData;
use App\Models\Dto\UserTransactionData;
use App\Models\Values\EmailData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\LaravelData\Concerns\DataTrait;
use Spatie\LaravelData\Contracts\DataObject;
use Spatie\LaravelData\WithData;
use Tests\Models\Dto\UserTransactionDataTest;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    // @Data
    // Using this trait automatically adds a `getData` method to the class
    use WithData;

    //@Data
    //This tells the pkg which dto class to use
    public string $dataClass = UserData::class;

    //@Data
    // Or, instead of using the $dataClass property,
    // this method can tell the pkg which dto to use.
    public function dataClass(): string
    {
        return UserData::class;
    }

    protected $casts = [
        'email_verified_at' => 'datetime',
        'email' => EmailData::class
    ];

    /**
     * {@see UserTransactionDataTest}
     */
    public function transactionData(): UserTransactionData
    {
        return UserTransactionData::from([
            'userEmail' => $this->email,
            'transactions' => $this->transactions->all()
        ]);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
