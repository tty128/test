@extends('layouts.manage_app')

@section('content')

    <laravel-main-handle token="{{Auth::user()->api_token}}"></laravel-main-handle>

@endsection
