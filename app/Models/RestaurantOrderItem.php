<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantOrderItem extends Model
{
    use HasFactory;

    protected $table = 'restaurant_order_items';

    protected $fillable = [
        'customer_id',
        'company_id',
        'order_type',
        'order_id',
        'menu_item_id',
        'quantity',
        'price',
        'customization_notes',
        'add_ons',
    ];

    protected $casts = [
        'add_ons' => 'array',
        'price' => 'decimal:2',
    ];

    public function customer()
    {
        return $this->belongsTo(customer::class, 'customer_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class, 'menu_item_id');
    }
}
