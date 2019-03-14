<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apply extends Model
{
    protected $guarded = ['id'];
    
    public function user(){
      return $this->belongsto('App\User');
    }
}
