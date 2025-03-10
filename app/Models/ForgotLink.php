<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForgotLink extends Model
{
    use HasFactory;

    protected $table = 'forgot_link';

    protected $fillable = ['user_id','email','contact','link'];
}
