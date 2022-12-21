<?php

namespace Tests\Models\Dto;

use App\Models\Dto\UserData;
use App\Models\User;
use App\Models\Values\EmailData;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Assert;
use Tests\TestCase;

class UserDataTest extends TestCase
{
    // Automatically re-migrates db before every test
    use RefreshDatabase;

    /** @test */
    public function it_casts_into_user_data ()
    {
        // Put a User in the db
        User::factory()->create();
        //User::factory()->create(['email_verified_at' => now()->subDays(27)]);

        // Pull the User out of the db
        /** @var User $user */
        $user = User::first();

        // Cast to dto
        $userData = $user->getData();

        Assert::assertInstanceOf(UserData::class, $userData);

        Assert::assertInstanceOf(EmailData::class, $user->email);
    }
}
