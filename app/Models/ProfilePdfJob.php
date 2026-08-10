<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilePdfJob extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'slug',
        'profile_url',
        'status',
        'file_path',
        'error_message',
    ];
}
