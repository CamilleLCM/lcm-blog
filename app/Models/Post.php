<?php

namespace App\Models;

use App\Models\Model;

class Post extends Model
{
    protected $table = 'posts';

    //关联用户表
    public function user(){
        return $this->belongsTo('\App\Models\User','user_id','id');
    }

    //关联评论表
    public function comment(){
        return $this->hasMany('\App\Models\Comment','post_id','id')->orderByDesc('created_at');
    }
}
