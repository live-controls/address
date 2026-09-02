<?php

namespace LiveControls\Address\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Address extends Model
{
    public function __construct(array $attributes = [])
    {
        $this->setTable(
            config('live-controls.address.config.address_table', 'addresses')
        );
        parent::__construct($attributes);
    }
    
    protected $fillable = [
        'country_code',
        'state',
        'city',
        'postal_code',
        'street',
        'number',
        'complement',
        'neighborhood',

        'longitude',
        'latitude',
    ];

    public function addressable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute<string,never>
     */
    protected function fullAddress(): Attribute
    {
        return Attribute::get(fn (): string => collect([
            trim("{$this->street}, {$this->number}"),
            $this->complement,
            $this->neighborhood,
            trim("{$this->city} - {$this->state}"),
            $this->postal_code,
            $this->country_code,
        ])
            ->filter()
            ->implode(', '));
    }
}