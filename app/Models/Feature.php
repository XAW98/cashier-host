<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;
    protected $table = 'features';
    protected $fillabel = [
        'id',
        'name_ar',
        'name_en',
        'name_tr'
    ];
    // protected $hidden = [];
    // public $timestamps = false;
    public function subscribes_features(){
        return $this->hasMany(SubscribeFeature::class);
    }
    public function subscribes(){
        return $this->belongsToMany(Subscribetion::class, 'subscribes_features', 'feature_id', 'subscribetion_id');
    }
}
