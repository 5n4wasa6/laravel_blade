<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function goal(){
      return $this->hasMany('App\Goal');
    }
    
    // クラブ----------------------------
    public function club(){
      return $this->hasMany('App\Club');
    }
    public function clubid(){
      return $this->hasMany('App\ClubId');
    }
    public function event(){
      return $this->hasMany('App\Event');
    }
    // クラブ----------------------------
    
    public function discussioncomment(){
      return $this->hasMany('App\DiscussionComment');
    }
    public function clubchat(){
      return $this->hasMany('App\Clubchat');
    }
    public function gauge(){
      return $this->hasMany('App\Gauge');
    }
    public function eventcomment(){
      return $this->hasMany('App\EventComment');
    }
    public function admin(){
      return $this->hasMany('App\Admin');
    }
    public function activitycomment(){
      return $this->hasMany('App\ActivityComment');
    }
    public function apply(){
      return $this->hasMany('App\Apply');
    }
    public function approval(){
      return $this->hasMany('App\Approval');
    }
}
