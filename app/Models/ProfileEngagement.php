<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileEngagement extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'action',
        'source',
    ];
}
