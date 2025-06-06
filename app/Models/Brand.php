<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $table = 'brand';

    protected $fillable = ['id','name','image'];   

    public function product_brand(){
        return $this->hasMany('App\Models\ProductBrand','brand_id');
    }    
    
}
