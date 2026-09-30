# Address
Simple address manipulation for Laravel with database storage

# Installation
1) Require from composer:
```bash
composer require live-controls/address;
```
2) Publish migrations:
```bash
php artisan vendor:publish --tag="live-controls.address.migrations";
```

# Single address
1) Add the following trait to your model:
```php
use LiveControls\Address\Traits\HasAddress;

class SomeModel extends Model
{
    use HasAddress;

    /* ... */
}
```

2) To store the address afterwards simply call:
```php
$address = [
    'country_code' => 'BR',
    'state' => 'MG',
    'city' => 'Belo Horizonte',
    'postal_code' => '30830000',
    'street' => 'Avenida Abilio Machado',
    'number' => '965',
    'complement' => 'Apt 1103',
    'neighborhood' => 'Alípio de Melo',
    'latitude' => -19.9044486,
    'longitude' => -44.0021370,
];

$model->updateAddress($address);
```

3) To return it's Address model simply call:
```php
$model->address;
```

4) To remove the Address do:
```php
$model->deleteAddress();
```

# Multiple addresses
1) Add the following trait to your model:
```php
use LiveControls\Address\Traits\HasAddresses;

class SomeModel extends Model
{
    use HasAddresses;

    /* ... */
}
```

2) To store the addresses afterwards simply call:
```php
$address = [
    'country_code' => 'BR',
    'state' => 'MG',
    'city' => 'Belo Horizonte',
    'postal_code' => '30830000',
    'street' => 'Avenida Abilio Machado',
    'number' => '965',
    'complement' => 'Apt 1103',
    'neighborhood' => 'Alípio de Melo',
    'latitude' => -19.9044486,
    'longitude' => -44.0021370,
];

$model->updateAddress('main', $address);
```

3) To return it's Address model simply call:
```php
$model->addressWithKey('main');
```

4) To remove the Address do:
```php
$model->deleteAddress('main');
```