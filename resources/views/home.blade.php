@extends('layouts.app')

@section('title', 'DePaul Alumni Outreach')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Latest Posts</h3>
                            </div>
                        </div>
                    </div>
                    <div>
                        <br>
                    @include('layouts.posts', ['posts' => $posts])
                    </div>
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
