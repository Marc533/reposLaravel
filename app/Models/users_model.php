<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class users_model extends Model
{
    use HasFactory;

     
    protected $fillable = [
        'user',
        'email',
        'tel',
        'sexe',
    ];
}
