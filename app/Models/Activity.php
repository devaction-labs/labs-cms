<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $customer_id
 * @property string $text
 */
class Activity extends Model
{
    use HasFactory;
}
