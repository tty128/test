@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    post
                </div>
            </div>
        </div>
    </div>
    <form method="POST" action="{{ route('postcreate') }}">
        @csrf

        <div class="form-group row">
            <label for="post_title" class="col-md-4 col-form-label text-md-right">Title</label>

            <div class="col-md-6">
                <input id="post_title" type="text" class="form-control" name="post_title"
                    value="{{ old('post_title') }}" required autofocus>
            </div>
        </div>

        <div class="form-group row">
            <label for="content" class="col-md-4 col-form-label text-md-right">Content</label>

            <div class="col-md-6">
                <input id="content" type="textarea" class="form-control"
                    name="post_content" required>
            </div>
        </div>


        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    CREATE
                </button>
            </div>
            {{ Auth::id() }}
        </div>
    </form>
</div>
@endsection
