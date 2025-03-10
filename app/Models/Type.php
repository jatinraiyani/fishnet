<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $table = 'type';

    protected $fillable = ['name','image'];

    public function type_category(){
        return $this->hasMany('App\Models\Category','type_id');
    }
}
