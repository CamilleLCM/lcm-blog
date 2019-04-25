<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel
{
    protected $table = 'posts';
    //不可注入的字段
    protected $guarded = [];

    //可注入的字段
//    protected $fillable = [
//        'title', 'content','user_id'
//    ];
}
