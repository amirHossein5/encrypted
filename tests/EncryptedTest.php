<?php

namespace Amir\Encryptable\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Attributes\Test;
use Workbench\App\Models\User;

class EncryptedTest extends TestCase
{
    use RefreshDatabase;

    private function createUser(array $data = []): array
    {
        $mergedData = array_merge([
            'name' => fake()->name,
            'email' => fake()->email,
        ], $data);

        User::create($mergedData);

        return $mergedData;
    }

    #[Test]
    public function encrypts_data()
    {
        ['name' => $name, 'email' => $email] = $this->createUser();

        $user = DB::table('users')->first();

        $this->assertEquals($name, Crypt::decrypt($user->name));
        $this->assertEquals($email, Crypt::decrypt($user->email));
    }

    #[Test]
    public function decrypts_data()
    {
        ['name' => $name, 'email' => $email] = $this->createUser();

        $user = User::first();

        $this->assertEquals($name, $user->name);
        $this->assertEquals($email, $user->email);
    }

    #[Test]
    public function wont_encrypt_null_value_columns()
    {
        $this->createUser(['name' => null]);

        $user = DB::table('users')->first();

        $this->assertEquals(null, $user->name);
    }

    #[Test]
    public function wont_decrypt_null_value_columns()
    {
        $this->createUser(['name' => null]);

        $this->assertEquals(null, User::first()->name);
    }
}
