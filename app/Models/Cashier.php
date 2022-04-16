<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cashier extends Model
{
    use HasFactory;
    protected $table = 'cashiers';
    protected $fillabel = [
        'id',
        'name',
        'email',
        'password',
        'domain',
        'domain_type',
        'user_id'
    ];
    // protected $hidden = [];
    // public $timestamps = false;
    public function user(){
        return $this->belongsTo(Client::class);
    }
}
