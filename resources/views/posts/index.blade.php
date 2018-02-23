@extends('layouts.app')

@section('title', 'Browse Posts')

@section('content')
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="row">
					<div class="col-md-4">
						<h2>Browse Posts</h2>
					</div>
					<div class="col-md-6"></div>
					<div class="col-md-2 col-sm-12">
						@if (Auth::user()->hasRole('admin'))
							<a href="{{ route('posts.create') }}" class="btn btn-block btn-primary btn-lg" style="margin-top: 18px">New Post</a>
						@endif
					</div>
				</div>
			</div>
			<div class="panel-body">
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
					<div class="row">
						<hr class="posts">
					</div>
				@endforeach
			</div>
			<div class="panel-footer">
				<div class="text-center">
					{{ $posts->links() }}
				</div>
			</div>
		</div>
	</div>
@stop
