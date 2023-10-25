<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $table = 'transaction_details';

    protected $fillable = [
        'transaction_id',
        'game_id',
        'quantity',
    ];


    public function transaction(){
        return $this->belongsTo(TransactionHeader::class, 'transaction_id', 'id');
    }

    public function game(){
        return $this->belongsTo(Game::class, 'game_id', 'id');
    }
}
