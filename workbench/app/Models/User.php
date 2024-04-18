<?php

namespace Workbench\App\Models;

use Amir\Encryptable\Encryptable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory, Encryptable;

    protected $encrypt = ['name', 'email'];

    protected $guarded = [];

    protected static function newFactory()
    {
        return \Workbench\Database\Factories\UserFactory::new();
    }
}
