## Usage

Use `\Amir\Encryptable\Encrypted` cast inside your model:

```php
<?php

use Amir\Encryptable\Encrypted;

class User extends Authenticatable
{
    // ...

    protected $casts = [
        'name' => Encrypted::class,
        'email' => Encrypted::class,
    ];
}
```

It'll encrypt and decrypt based on APP_KEY using laravel's Crypt facade
