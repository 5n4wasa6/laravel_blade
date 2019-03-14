<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    protected $guarded = ['id'];
    
    public function user(){
      return $this->belongsto('App\User');
    }
}
