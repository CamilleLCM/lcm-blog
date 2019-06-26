<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Requests\CreateRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Zan;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //文章列表
    public function index(){
        $posts = Post::orderByDesc('created_at')->withCount(['comment','zan'])->paginate(6);
        return view('post/index',compact('posts'));
    }
    //文章详情
    public function show(Post $post){
        $post->load('comment');
        return view('post/show',['post'=>$post],['isShow'=>true]);
    }
    //创建页面
    public function create(){

        return view('post.create');
    }
    //创建逻辑
    public function store(CreateRequest $request){
        $user_id = \Auth::id();
        //验证通过后保存进数据库
            Post::create([
                'title' => $request->title,
                'content' => $request->contents,
                'user_id' => $user_id
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
        //设置修改权限
        $this->authorize('update', $post);
        //验证通过后保存进数据库
       $post->title = $request->title;
       $post->content = $request->contents;
       $post->save();
        return redirect("/posts/{$post->id}");
    }
    //删除逻辑
    public function delete(Post $post){
        //设置删除权限
        $this->authorize('delete', $post);
       $post->delete();
       return redirect("/posts");
    }
    //上传图片
    public function imageUpload(Request $request){
        $path = $request->file('wangEditorH5File')->storePublicly(md5(time()));
        return asset('storage/'.$path);
    }

    //发表评论
    public function comment(CommentRequest $request,Post $post){
        //保存评论
        $comment = new Comment();
        $comment->user_id = \Auth::id();
        $comment->content = $request->input('content');
        $post->comment()->save($comment);
        //页面渲染
        return back();
    }

    //用户对文章进行赞
    public function zan(Post $post){

        $params = [
            'user_id'=>\Auth::id(),
            'post_id'=>$post->id,
        ];
        //firstOrCreate表里有相同的数据就查询没有就新建一条
        Zan::firstOrCreate($params);
        return back();
    }

    //用户对文章取消赞
    public function unZan(Post $post){
       $post->userZan(\Auth::id())->delete();
       return back();
    }
}
