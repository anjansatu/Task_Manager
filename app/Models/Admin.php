<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
        protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'email_verified',
        'email_verified_at',
        'status',
        'is_admin',
    ];
}
