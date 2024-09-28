<?php

namespace App\Models;

use App\Traits\Models\HasSearch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, Relations\HasMany, Relations\HasOne, SoftDeletes};

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $zip
 * @property string $country
 */
class Customer extends Model
{
    use HasFactory;
    use HasSearch;
    use SoftDeletes;

    public function company(): HasOne
    {
        return $this->hasOne(Company::class);
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function emails(): HasMany
    {
        return $this->hasMany(Email::class);
    }

    public function phones(): HasMany
    {
        return $this->hasMany(Phone::class);
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }

    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class);
    }
}
