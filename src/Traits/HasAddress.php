<?php

namespace LiveControls\Address\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use LiveControls\Address\Models\Address;

/**
 * @phpstan-require-extends Model
 */
trait HasAddress
{
    /**
     * Returns the address of the organization
     *
     * @return MorphOne<Address,$this>
     */
    public function address(): MorphOne
    {
        return $this->morphOne(Address::class, 'addressable');
    }
    
    /**
     * Updates or creates an address for the model.
     *
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
        array $input
    ): Address
    {
        return $this->address()->updateOrCreate([],$input);
    }
    
    public function deleteAddress(): void
    {
        $this->address()->delete();
    }
}