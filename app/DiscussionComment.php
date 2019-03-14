<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiscussionComment extends Model
{
    protected $guarded = ['id'];
    
    public function user() {
        return $this->belongsTo('App\User');
    }
    
    protected $fillable = [
        'user_id',
        'post_id',
        'reply_id',
        'body'
    ];
    public function replies()
    {
        return $this->hasMany('App\DiscussionComment', 'parent_id');
    }
}
