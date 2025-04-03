<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;

    protected $fillable = [
        'currency_type',
        'user_id',
        'from',
        'to',
        'admin_address',
        'amount',
        'fees',
        'transaction_id',
        'admin_transaction_id',
        'confirmations',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function depositMethod()
    {
        return $this->hasMany(DepositMethod::class, 'id', 'currency_type');
    }
}
