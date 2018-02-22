@extends('layouts.app')

@section('title', 'Browse Posts')

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-1 col-sm-6 col-sm-offset-5">
			<h1>All Posts</h1>
		</div>
		<div class="col-md-2 col-sm-12">
			@if (Auth::user()->hasRole('admin'))
				<a href="{{ route('posts.create') }}" class="btn btn-block btn-primary btn-lg" style="margin-top: 18px">New Post</a>
			@endif
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<br>
				@foreach ($posts as $post)
					<div class="row">
						<div class="col-md-10 col-md-offset-1 col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1">
							@if (Auth::user()->hasRole('admin'))
								<a href="{{ route('posts.edit', $post->id) }}" class="btn btn-default btn-sm">Edit</a>
							@endif
							<p class="h4">
								{{ $post->title }}
								<span class="text-muted pull-right">
									By <strong>{{ $post->user->name }}</strong> on
									{{ date('M j, Y', strtotime($post->created_at)) }}
                        </span>
							</p>
							<hr>
							<p>{!! $post->body !!}</p>
						</div>
					</div>
					<hr class="posts">
				@endforeach
			</div>
		</div>
	</div>
	<div class="row">
		<div class="text-center">
			{{ $posts->links() }}
		</div>
	</div>
@stop
