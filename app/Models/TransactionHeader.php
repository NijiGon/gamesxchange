<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionHeader extends Model
{
    use HasFactory;

    protected $table = 'transaction_headers';

    protected $fillable = [
        'user_id',
        'transaction_date',
        'platform_id',
        'method_id',
    ];

    public function platform(){
        return $this->belongsTo(Platform::class, 'platform_id', 'id');
    }

    public function method(){
        return $this->belongsTo(TransactionMethod::class, 'method_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function details(){
        return $this->hasMany(TransactionDetail::class, 'transaction_id');
    }
}
