## Usage

Use `\AmirHossein5\Encrypted\Encrypted` cast inside your model:

```php
<?php

use AmirHossein5\Encrypted\Encrypted;

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
