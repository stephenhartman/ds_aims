@extends('layouts.app')

@section('title', 'All Posts')

@section('content')
	<div class="row">
		<div class="col-md-8">
			<h1>All Posts</h1>
		</div>
		<div class="col-md-2">
			@if (Auth::user()->hasRole('admin'))
				<a href="{{ route('posts.create') }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">Create New Post</a>
			@endif
		</div>
		<div class="col-md-12">
			<hr>
		</div>
	</div> <!-- end of .row -->
	<div class="row">
		<div class="col-md-12">
			<table class="table">
				<thead>
				<th>#</th>
				<th>Title</th>
				<th>Body</th>
				<th>Created At</th>
				<th></th>
				</thead>
				<tbody>
				@foreach ($posts as $post)
					<tr>
						<th>{{ $post->id }}</th>
						<td><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></td>
						<td>{{ substr($post->body, 0, 50) }}{{ strlen($post->body) > 50 ? "..." : "" }}</td>
						<td>{{ date('M j, Y', strtotime($post->created_at)) }}</td>
						<td>
						@if (Auth::user()->hasRole('admin'))
							<a href="{{ route('posts.show', $post->id) }}" class="btn btn-default btn-sm">View</a> <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-default btn-sm">Edit</a></td>
						@endif
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>
@stop