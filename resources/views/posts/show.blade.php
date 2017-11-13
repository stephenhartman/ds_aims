@extends('layouts.app')

@section('title2', '| View DePaul Administrator Post')

@section('content')

	<div class="row">
		<div class="col-md-8">
			<h1>{{ $post->title }}</h1>
		
			
		<table>
		<tbody><tr>
			<th></th>
			<p class="lead">{{ $post->body }}</p>
		</tr>
		<tr>
			<td>Post was created at:</td>
			<td>{{ date('M j, Y h:ia', strtotime($post->created_at)) }}</td>
		</tr>
		<tr>
			<td>Post was last updated: </td>
			<td>{{ date('M j, Y h:ia', strtotime($post->updated_at)) }}</td>
		</tr>

		<tr>
			<td>{!! Html::linkRoute('posts.edit', 'Edit', array($post->id), array('class' => 'btn btn-info btn-block')) !!}</td>
			<td></td>
		</tr>
		{!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'DELETE']) !!}
		<tr>
			<td>{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block']) !!}</td>
			<td></td>
		</tr>
		
		
	</tbody></table>
			
			
			
		{!! Form::close() !!}	
		</div>

		

		
		
@endsection