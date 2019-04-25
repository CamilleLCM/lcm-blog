<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //文章列表
    public function index(){
        $posts = Post::orderByDesc('created_at')->paginate(6);
        return view('post/index',compact('posts'));
    }
    //文章详情
    public function show(Post $post){
        return view('post/show',['post'=>$post],['isShow'=>true]);
    }
    //创建页面
    public function create(){

        return view('post/create');
    }
    //创建逻辑
    public function store(CreateRequest $request){
            $post = Post::create([
                'title' => $request->title,
                'content' => $request->contents
            ]);
            return redirect("/posts");

    }
    //编辑页面
    public function edit(){
        return view('post/edit');
    }
    //编辑逻辑
    public function update(){

    }
    //删除逻辑
    public function delete(){

    }
}
