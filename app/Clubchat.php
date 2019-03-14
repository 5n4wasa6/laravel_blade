<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clubchat extends Model
{
    protected $guarded = ['id'];
  
    public function user(){
      return $this->belongsto('App\User');
    }
    // public function club(){
    //   return $this->belongsTo('App\Club');
    // }
}
