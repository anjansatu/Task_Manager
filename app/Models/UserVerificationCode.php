<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVerificationCode extends Model
{
    use HasFactory;

    protected $fillable = ['email','code','expired_at','type'];
}
