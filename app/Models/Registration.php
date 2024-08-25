<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id
 * @property string $customer_id
 * @property string $state
 * @property string $number
 * @property string $enabled
 * @property string $status_date
 * @property string $status_id
 * @property string $type_id
 */
class Registration extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $keyType = 'string';

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }
}
