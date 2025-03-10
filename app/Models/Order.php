<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';
    
    protected $fillable = ['user_id','ordernumber','subtotal','tax','delivery_charge','discount','promo','grand_total','note','address','payment_method','transaction_id','order_status','cancel_reason','slip','payment_status'];

    public function order_product(){
        return $this->hasMany('App\Models\OrderProduct','order_id');
    }

    public function order_status(){
        return $this->hasMany('App\Models\OrderStatus','order_id');
    }

    public function Payment(){
        return $this->hasMany('App\Models\Payment','order_id');
    }

    public function delivery_address(){
        return $this->belongsTo('App\Models\UserAddress','address');
    }

    public function order_user(){
        return $this->belongsTo('App\Models\User','user_id');
    }


}
