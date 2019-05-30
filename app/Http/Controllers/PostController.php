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

        return view('post.create');
    }
    //创建逻辑
    public function store(CreateRequest $request){
        //验证通过后保存进数据库
            Post::create([
                'title' => $request->title,
                'content' => $request->contents
            ]);
            //渲染页面
            return redirect("/posts");

    }
    //编辑页面
    public function edit(Post $post){
        return view('post/edit',compact('post'));
    }
    //编辑逻辑
    public function update(CreateRequest $request ,Post $post){
        //验证通过后保存进数据库
       $post->title = $request->title;
       $post->content = $request->contents;
       $post->save();
        return redirect("/posts/{$post->id}");
    }
    //删除逻辑
    public function delete(Post $post){
        //TODO:用户的权限认证必须为作者才能删除
       $post->delete();
       return redirect("/posts");
    }
    //上传图片
    public function imageUpload(Request $request){
        $path = $request->file('wangEditorH5File')->storePublicly(md5(time()));
        return asset('storage/'.$path);
    }
}
