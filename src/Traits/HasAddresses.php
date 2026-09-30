<?php

namespace LiveControls\Address\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use LiveControls\Address\Models\Address;

/**
 * @phpstan-require-extends Model
 */
trait HasAddresses
{
    /**
     * Returns the address of the organization
     *
     * @return MorphMany<Address,$this>
     */
    public function addresses(): MorphMany
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    /**
     * Returns the address with a specific key set
     *
     * @param string $key
     * @return Address|null
     */
    public function addressWithKey(string $key): ?Address
    {
        return $this->addresses()->where('key', $key)->first();
    }
    
    /**
     * Updates or creates an address with a specific key.
     *
     * @param string $key
     * @param array{
     *  country_code?: string,
     *  state?: string,
     *  city?: string,
     *  postal_code?: string,
     *  street?: string,
     *  number?: string,
     *  complement?: string,
     *  neighborhood?: string,
     *  longitude?: float,
     *  latitude?: float
     * } $input
     * @return Address
     */
    public function updateAddress(
        string $key, 
        array $input
    ): Address
    {
        unset($input['key']);
        return $this->addresses()->updateOrCreate([
            'key' => $key
        ], $input);
    }
    
    public function deleteAddress(string $key): void
    {
        $this->addresses()->where('key', $key)->delete();
    }
}