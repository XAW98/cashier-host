<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payments';
    protected $fillabel = [
        'id',
        'price',
        'date_of_pay',
        'card_id',
        'subscribetion_id',
        'user_id',
    ];
    // protected $fillabel = []
    // public $timestamps = false;
    public function user(){
        return $this->belongsTo(Client::class);
    }
    public function card(){
        return $this->belongsTo(Card::class);
    }
    public function subscribetion(){
        return $this->belongsTo(Subscribetion::class);
    }
}
