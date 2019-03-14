<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
  protected $dates   = ['commit_at'];
  
  public function user(){
    return $this->belongsTo('App\User');
  }
}
