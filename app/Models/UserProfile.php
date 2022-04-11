<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'surname',
        'gender',
        'age',
        'country',
        'city',
        'profile_picture',
        'description'
    ];

    protected $hidden = [
        'remember_token'
    ];

}
