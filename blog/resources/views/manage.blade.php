@extends('layouts.manage_app')

@section('content')
<div class="container">
    <ul>
        <router-link :to="{name: 'post.list'}" tag="li">
            Post
        </router-link>
        <router-link v-bind:to="{name: 'term.list'}" tag="li">
            term
        </router-link>
    </ul>
    <router-view
        token="{{Auth::user()->api_token}}"
    >
    </router-view>
</div>
@endsection
