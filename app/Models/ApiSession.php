<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiSession extends Model
{
    use HasFactory;

    protected $table = 'api_sessions';

    protected $fillable = ['session_id','user_id'];
}
