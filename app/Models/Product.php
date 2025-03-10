<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';
    
    protected $fillable = ['name','type_id','category_id','subcategory_id','product_unit','description','image','color','price','old_price','discount_title','status'];

    public function product_image(){
        return $this->hasMany('App\Models\ProductImage','product_id');
    }

    public function product_size(){
        return $this->hasMany('App\Models\ProductSize','product_id');
    }

    public function product_color(){
        return $this->hasMany('App\Models\ProductColor','product_id');
    }

    public function product_type(){
        return $this->belongsTo('App\Models\Type','type_id');
    }

    public function product_category(){
        return $this->belongsTo('App\Models\Category','category_id');
    } 

    public function product_subcategory(){
        return $this->belongsTo('App\Models\SubCategory','subcategory_id');
    } 
    
    public function product_brand(){
        return $this->hasMany('App\Models\ProductBrand','product_id');
    }    

}
