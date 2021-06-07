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
        $post = $post->where('post_author', '=', $request->user()->id)
            ->orWhere('post_status', '<>', 'private')
            ->orderBy('created_at', 'desc')
            ->get([
                'post_id',
                'post_author',
                'post_update_author',
                'created_at',
                'updated_at',
                'post_status',
                'post_title'
            ]);
        return $post;

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
    public function show(Post $post)
    {
        switch ($post->post_status) {
            case 'public':
                return $post;

            case 'private':
                return Auth::id() == $post->post_author ? $post : ['error' => '記事は非公開です'];

            case 'member':
                return Auth::check() ? $post : redirect()->route('login');

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
            $creater = $post->post_author === $request->user()->id ? true : false;
            $status = $post->post_status !== 'private' ? true : false;
            if ($status || $creater) {
                return true;
            }
        }
        return false;
    }
}
