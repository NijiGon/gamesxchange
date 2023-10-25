<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';

    protected $fillable = [
        'user_id', 'game_id', 'rating', 'like', 'dislike', 'comment',
    ];
    
    // protected $primaryKey = ['user_id', 'game_id'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    } 

    public function game(){
        return $this->belongsTo(Game::class, 'game_id', 'id');
    }
}
