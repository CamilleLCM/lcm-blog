<?php

namespace App\Models;

use App\Models\Model;

class Comment extends Model
{
    protected $table = 'comments';

    public function post(){
        return $this->belongsTo('\App\Models\Post','id','post_id');
    }

    public function user(){
        return $this->belongsTo('\App\Models\User');
    }
}
