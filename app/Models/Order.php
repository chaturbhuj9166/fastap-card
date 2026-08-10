<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{    
    // public $timestamps = false;

    use HasFactory;
    public function user(){
        return $this->belongsTo(customer::class,'user_id');
    }
    
    public function products(){
        return $this->hasMany(OrderProduct::class,'order_id');
    }
    
    public function couponDetail(){
        return $this->belongsTo(coupon::class,'coupon');
    }
    
    public function agentDetail(){
        return $this->belongsTo(Agent::class,'agent_code');
    }
}
