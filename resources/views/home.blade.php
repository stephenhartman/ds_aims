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
                        You are logged in!
                    </div>
							<div>
						
							@foreach ($posts as $post)
							<div class="row">
		
							<div class="col-md-8 col-md-offset-2">
							<p>{{ $post->title }}</p>
							<p>{{ $post->body }}</p>
							<hr>
						</div>
						</div>
						@endforeach
					
                </div>
            </div>
        </div>
    </div>
@endsection
