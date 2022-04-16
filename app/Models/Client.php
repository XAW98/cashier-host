<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Client extends Authenticatable
{
    use HasFactory;
    protected $table = 'clients';
    protected $fillable = [
        'id',
        'full_name',
        'email',
        'phone',
        'password'
    ];
    // protected $hidden = [];
    // public $timestamps = false;
    public function Cashiers(){
        return $this->hasMany(Cashier::class);
    }
    public function payments(){
        return $this->hasMany(payments::class);
    }
    public function cards(){
        return $this->hasMany(Card::class);
    }
}
