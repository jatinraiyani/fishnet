<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $table = 'subcategory';

    protected $fillable = ['id','type_id','category_id','name','image','status'];

    public function type_category(){
        return $this->belongsTo('App\Models\Type','type_id');
    }

    public function sub_category(){
        return $this->belongsTo('App\Models\Category','category_id');
    }
}
