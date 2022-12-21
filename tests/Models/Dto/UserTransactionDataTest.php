<?php

namespace Tests\Models\Dto;

use App\Models\Dto\TransactionData;
use App\Models\Dto\UserTransactionData;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Assert;
use Tests\TestCase;

class UserTransactionDataTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_be_casted_as_a_user_attribute ()
    {
        /** @var User $user */
        $user = User::factory()
            ->has(Transaction::factory(5), 'transactions')
            ->create(['email' => 'johndoe@example.com']);

        $userTransactionData = $user->transactionData();

        Assert::assertInstanceOf(UserTransactionData::class, $userTransactionData);

        foreach ($userTransactionData->transactions as $trx) {
            Assert::assertInstanceOf(TransactionData::class, $trx);
        }

        /**
         * @Data
         * Notice when we call toArray, we automatically have an array of nested transactions,
         * This being what you're going for in the rtnApi
         */
        dump($userTransactionData->toArray());
    }
}
