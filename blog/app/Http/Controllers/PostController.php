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
        return view('post');
    }

    public function apiIndex(){
        $posts = Post::where('post_author','=', Auth::id())
                    ->orWhere('post_status','<>','private')
                    ->orderBy('created_at', 'desc')
                    ->paginate(12);
        return $posts;

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
        if($this->runCheck($request, $post)){
            $post->update($request->all());
        };
        return redirect()->route('post.all');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $post = Post::find($id);
        if ($this->runCheck($request, $post)) {
            $post->delete();
        };
        return redirect()->route('post.all');
    }

    public function runCheck(Request $request, Post $model)
    {
        if (isset($model, $request)) {
            $creater = $model->post_author === Auth::id() ? true : false;
            $status = $model->post_status !== 'private' ? true : false;
            if ($status || $creater) {
                return true;
            }
        }
        return false;
    }
}
