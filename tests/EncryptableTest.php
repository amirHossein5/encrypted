<?php

namespace Amir\Encryptable\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Crypt;
use PHPUnit\Framework\Attributes\Test;
use Workbench\App\Models\User;

class EncryptableTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function encrypts_data_on_create()
    {
        $user = User::create([
            'name' => $name = fake()->name,
            'email' => $email = fake()->email,
        ]);

        $this->assertEquals($name, Crypt::decrypt($user->name));
        $this->assertEquals($email, Crypt::decrypt($user->email));
    }

    #[Test]
    public function encrypts_data_on_update()
    {
        $user = User::factory()->create();

        $user->update([
            'name' => $newName = fake()->name,
            'email' => $newEmail = fake()->email,
        ]);

        $this->assertEquals($newName, Crypt::decrypt($user->name));
        $this->assertEquals($newEmail, Crypt::decrypt($user->email));
    }

    #[Test]
    public function decrypts_when_retreiving_model()
    {
        User::factory()->create([
            'name' => $name = fake()->name,
            'email' => $email = fake()->email,
        ]);

        $user = User::first();

        $this->assertEquals($name, $user->name);
        $this->assertEquals($email, $user->email);
    }
}
