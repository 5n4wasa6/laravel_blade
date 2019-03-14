<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    public function user(){
      return $this->belongsTo('App\User');
    }
    // public function clubchats(){
    //   return $this->hasMany('App\Clubchat');
    // }
}
