<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function comments() {
        return $this->morphMany('App\DiscussionComment', 'commentable')->whereNull('parent_id');
    }
}
