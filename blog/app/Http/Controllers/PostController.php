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
    public function index(Request $request,Post $post)
    {
        $auth_id = isset($request->user()->id) ? $request->user()->id : Auth::id();
        $post = $post
            ->where('author', '=', $auth_id)
            ->orWhere('status', '<>', 'private')
            ->orderBy('post.id', 'desc')
            ->join('users as pca', 'author', '=', 'pca.id')
            ->leftJoin('users as pua', 'update_author', '=', 'pua.id')
            ->get([
                'post.id',
                'post.created_at',
                'post.updated_at',
                'status',
                'title',
                'pca.name as author_name',
                'pua.name as update_author_name',
            ]);

        return ['post' => $post];

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Post $post)
    {
        $post->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Post $post)
    {
        switch ($post->status) {
            case 'public':
                return $post;

            case 'private':
                return $request->user()->id == $post->author ? $post : ['error' => '記事は非公開です'];

            case 'member':
                return isset($request->user()->id) ? $post : redirect()->route('login');

            default:
                return redirect()->route('login');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($limit, $id)
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
    public function update(Request $request,Post $post)
    {
        if($this->runCheck($request, $post)){
            $post->update($request->all());
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Post $post)
    {
        if ($this->runCheck($request, $post)) {
            $post->delete();
        };
    }

    public function runCheck(Request $request, Post $post)
    {
        if (isset($post, $request)) {
            $creater = $post->author === $request->user()->id ? true : false;
            $status = $post->status !== 'private' ? true : false;
            if ($status || $creater) {
                return true;
            }
        }
        return false;
    }
}
