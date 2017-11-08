@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="panel-title">Dashboard</div>
                        </div>
                        <div class="col-md-2">
                            <a class="btn btn-sm btn-primary" href="{{ route('posts.create') }}">Create new post</a>
                        </div>
                        <div class="col-md-2">
                            <a class="btn btn-sm btn-primary" href="{{ route('events.create') }}">Create new event</a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
