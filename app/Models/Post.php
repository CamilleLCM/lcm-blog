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

    //关联赞表
    public function zan(){
        return $this->hasMany('\App\Models\Zan','post_id','id');
    }

    //和某个用户进行关联
    public function userZan($user_id){
        return $this->hasOne('\App\Models\Zan')->where('user_id',$user_id);
    }

}
