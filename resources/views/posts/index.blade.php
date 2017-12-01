@extends('layouts.app')

@section('title', 'All Posts')

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-1">
			<h1>All Posts</h1>
		</div>
		<div class="col-md-2">
			@if (Auth::user()->hasRole('admin'))
				<a href="{{ route('posts.create') }}" class="btn btn-block btn-primary btn-lg" style="margin-top: 18px">Create New Post</a>
			@endif
		</div>
	</div>
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<hr>
		</div>
	</div>
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<table class="table">
				<thead>
				<th>Author</th>
				<th>Title</th>
				<th>Body</th>
				<th>Created On</th>
				<th></th>
				</thead>
				<tbody>
				@foreach ($posts as $post)
					<tr>
						<th>{{ $post->user->name }}</th>
						<td>{{ $post->title }}</td>
						<td>{{ substr($post->body, 0, 50) }}{{ strlen($post->body) > 50 ? "..." : "" }}</td>
						<td>{{ date('M j, Y', strtotime($post->created_at)) }}</td>
						<td>
							<a href="{{ route('posts.show', $post->id) }}" class="btn btn-default btn-block btn-sm">View</a>
							@if (Auth::user()->hasRole('admin'))
								<a href="{{ route('posts.edit', $post->id) }}" class="btn btn-default btn-block btn-sm">Edit</a>
							@endif
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<div class="row">
		<div class="text-center">
			{{ $posts->links() }}
		</div>
	</div>
@stop