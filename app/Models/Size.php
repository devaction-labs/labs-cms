<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $acronym
 * @property string $text
 */
class Size extends Model
{
    use HasFactory;
    use HasUuids;

    public $incrementing = false;

    public $keyType = 'string';
}
