<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    use HasFactory;

    protected $table = 'product_color';    
    protected $fillable = ['product_id','color_name','color_code'];

    public function product_color(){
        return $this->belongsTo('App\Models\Product','product_id');
    }
}
