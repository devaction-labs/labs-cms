<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $email
 * @property string $customer_id
 * @property string $domain
 */
class Email extends Model
{
    use HasFactory;
}
