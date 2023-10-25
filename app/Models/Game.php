<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Game extends Model
{
    use HasFactory;

    protected $table = 'games';

    protected $fillable = [
        'dev_id', 'name', 'description', 'price', 'image', 'genre'
    ];

    public function developer(){
        return $this->belongsTo(Developer::class, 'dev_id', 'id');
    }

    public function transactions(){
        return $this->hasMany(TransactionDetail::class, 'game_id');
    }

    public function reviews(){
        return $this->hasMany(Review::class, 'game_id');
    }

    public function carts(){
        return $this->hasMany(Cart::class, 'game_id');
    }

    public function ratings(){
        return $this->hasMany(Review::class)
            ->selectRaw('AVG(rating) as average_rating')
            ->groupBy('game_id');
    }
}
