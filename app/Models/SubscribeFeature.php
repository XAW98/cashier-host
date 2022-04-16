<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscribeFeature extends Model
{
    use HasFactory;
    protected $table = 'subscribes_features';
    protected $fillabel = [
        'id',
        'limitation',
        'status',
        'features_id',
        'subscribetion_id'
    ];
    // protected $hidden = [];
    // public $timestamps = false;
    public function subscribetion(){
        return $this->belongsTo(Subscribetion::class);
    }
    public function feature(){
        return $this->belongsTo(Feature::class);
    }
}
