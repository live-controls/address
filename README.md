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
1) Add the following line to the model you want to have a single address for:
```php
/**
 * Returns the address of the organization
 *
 * @return MorphOne<Address,$this>
 */
public function address(): MorphOne
{
    return $this->morphOne(Address::class, 'addressable');
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

$model->address()->updateOrCreate([], $address);
```

3) To return it's Address model simply call:
```php
$model->address;
```

# Multiple addresses
1) Add the following line to the model you want to have multiple addresses for:
```php
/**
 * Returns the address of the organization
 *
 * @return MorphMany<Address,$this>
 */
public function addresses(): MorphMany
{
    return $this->morphMany(Address::class, 'addressable');
}
```

2) To store the addresses afterwards simply call:
```php
$address = [
    'key' => 'main', //This line is important for multiple addresses as you can use this as index for the address
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

$model->addresses()->create($address);
```

3) To return it's Address model simply call:
```php
$model->addresses()->where('key', 'main')->first();
```