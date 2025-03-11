<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'status',
    ];

    public function ssn()
    {
        return $this->hasMany(Ssn::class);
    }
}
