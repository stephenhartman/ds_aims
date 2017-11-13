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
                        </div>
                    </div>
                    <div class="panel-body">
                        <h3>The latest news from The DePaul School</h3>
                    </div>
                    @include('layouts.posts', ['posts' => $posts])
                    <br>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <a class="btn btn-primary btn-block" href="{{ URL::to('posts') }}">More Posts</a>
                        </div>
                    </div>
                    <div class="row">
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
