<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';
    
    protected $fillable = ['type_id','name','image','status'];

    public function type_category(){
        return $this->belongsTo('App\Models\Type','type_id');
    }

    public function sub_category(){
        return $this->hasMany('App\Models\SubCategory','category_id');
    }
}
