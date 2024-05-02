<?php

namespace Workbench\App\Models;

use Amir\Encryptable\Encrypted;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'name' => Encrypted::class,
        'email' => Encrypted::class,
    ];

    protected static function newFactory()
    {
        return \Workbench\Database\Factories\UserFactory::new();
    }
}
