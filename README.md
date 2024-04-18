## Usage

Add `\Amir\Encryptable\Encryptable` trait to your model, and define encryptable properties:

```php
<?php

use Amir\Encryptable\Encryptable;

class User extends Authenticatable
{
    use Encryptable;

    protected $encrypt = ['name', 'email'];
}
```
