<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gauge extends Model
{
    protected $guarded = ['id'];
    protected $dates   = ['activity_at'];
    
    public function user(){
        return $this->belongsTo('App\User');
    }
    // public function profile(){
    //     return $this->belongsTo('App\Profile');
    // }
}
