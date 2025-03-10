<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    use HasFactory;

    protected $table = 'product_size';    
    protected $fillable = ['product_id','size_unit','size','weight','price','chart','size_available'];

    public function product_size(){
        return $this->belongsTo('App\Models\Product','product_id');
    }
}
