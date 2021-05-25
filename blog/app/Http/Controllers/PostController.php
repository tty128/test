<?php

namespace App\Http\Controllers;
use App\Post;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('post.all');
    }

    public function apiIndex()
    {
        return Post::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* 
            update 2021-05-25
            modelメソッドを起動しDBに入力したいだけのコントロールメソッドだったのに
            JSONを返していた問題を修正し、記事一覧へリダイレクトする設定に変更
        */
        if(isset($request)){
            Post::create($request->all());
        }
        return redirect()->route('post.all');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        switch ($post->post_status) {
            case 'public':
                return $post;

            case 'private':
                return Auth::id() === $post->post_author ? $post : redirect()->route('post.all');

            case 'member':
                return Auth::check() ? $post : redirect()->route('post.all');

            default:
                return redirect()->route('post.all');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        if(isset($post) && isset($request)){
            $creater = $post->post_author === Auth::id() ? true : false;
            $status = $post->post_status === 'private' ? true : false;
            if(!$status || ($status && $creater)){
                $post->update($request->all());
            }
        }
        return redirect()->route('post.all');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if(isset($post) && isset($request)){
            $creater = $post->post_author === Auth::id() ? true : false;
            $status = $post->post_status === 'private' ? true : false;
            if(!$status || ($status && $creater)){
                $post->delete();
            }
        }
        return redirect()->route('post.all');
    }
}
