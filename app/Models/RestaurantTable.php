<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantTable extends Model
{
    use HasFactory;

    protected $table = 'restaurant_tables';

    protected $fillable = [
        'customer_id',
        'company_id',
        'profile_id',
        'table_number',
        'table_type',
        'seating_capacity',
        'qr_code_path',
        'status',
        'location_area',
    ];

    public function customer()
    {
        return $this->belongsTo(customer::class, 'customer_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function profile()
    {
        return $this->belongsTo(RestaurantProfile::class, 'profile_id');
    }

    public function orders()
    {
        return $this->hasMany(TableOrder::class, 'table_id');
    }
}
