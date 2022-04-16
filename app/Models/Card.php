<?php

namespace App\Models;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;
    protected $table = 'cards';
    protected $fillabel = [
        'id',
        'type',
        'number',
        'cvv',
        'expiration_date',
        'user_id'
    ];
    // protected $hidden = [];
    // public $timestamps = false;
    public function payments(){
        return $this->hasMany(Payment::class);
    }
    public function client(){
        return $this->belongsTo(Client::class);
    }
}
