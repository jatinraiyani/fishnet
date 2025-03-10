<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    protected $table = 'order_product';
    
    protected $fillable = ['user_id','order_id','product_id','uniqueId','product_name','product_unit','size','price','qty'];  
    
    public function product_image(){
        return $this->belongsTo('App\Models\Product','product_id');
    }
    
}
