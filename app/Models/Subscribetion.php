<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscribetion extends Model
{
    use HasFactory;
    protected $table = 'subscribetions';
    protected $fillabel = [
        'id',
        'name_ar',
        'name_en',
        'name_tr',
        'price',
        'period'
    ];
    // protected $hidden = [];
    // public $timestamps = false;
    public function payments(){
        return $this->hasMany(Payment::class);
    }
    public function subscribes_features(){
        return $this->hasMany(SubscribeFeature::class);
    }
    public function features(){
        return $this->belongsToMany(Feature::class, 'subscribes_features', 'subscribetion_id', 'feature_id');
    }
}
