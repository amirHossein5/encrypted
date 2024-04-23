<?php

namespace Amir\Encryptable\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Attributes\Test;
use Workbench\App\Models\User;

class EncryptableTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function encrypts_data_on_create()
    {
        User::create([
            'name' => $name = fake()->name,
            'email' => $email = fake()->email,
        ]);

        $user = DB::table('users')->first();

        $this->assertEquals($name, Crypt::decrypt($user->name));
        $this->assertEquals($email, Crypt::decrypt($user->email));
    }

    #[Test]
    public function encrypts_data_on_update()
    {
        User::factory()->create()->update([
            'name' => $newName = fake()->name,
            'email' => $newEmail = fake()->email,
        ]);

        $newUser = DB::table('users')->first();

        $this->assertEquals($newName, Crypt::decrypt($newUser->name));
        $this->assertEquals($newEmail, Crypt::decrypt($newUser->email));
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

    #[Test]
    public function wont_encrypt_null_value_columns()
    {
        User::factory()->create([
            'name' => null,
            'email' => $email = fake()->email,
        ]);

        $user = DB::table('users')->first();

        $this->assertEquals(null, $user->name);
    }
}
