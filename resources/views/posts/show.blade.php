@extends('layouts.app')

@section('title', $post->title)

@section('content')
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="row">
					<div class="col-md-8">
						<div class="panel-title">
							<h4>{{ $post->title }}</h4>
						</div>
					</div>
				</div>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<p class="lead">{!! $post->body !!}</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<p>Post was created at: {{ date('M j, Y h:ia', strtotime($post->created_at)) }}</p>
					</div>
					<div class="col-md-6">
						<p>Post was last updated:  {{ date('M j, Y h:ia', strtotime($post->updated_at)) }}</p>
					</div>
				</div>
			</div>
			<div class="panel-footer">
				<div class="row">
					@if (Auth::user()->hasRole('admin'))
					<div class="col-md-6">
						{{ Form::open(['method' => 'GET', 'route' => ['posts.edit', $post->id]]) }}
						{{ Form::button('<i class="fa fa-edit"></i> Edit', array(
                            'type' => 'submit',
                            'class' => 'btn btn-info btn-lg btn-block')) }}
						{{ Form::close() }}
					</div>
					<div class="col-md-6">
						{{ Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'DELETE']) }}
						{{ Form::button('<i class="fa fa-trash"></i> Delete', array(
                            'type' => 'submit',
                            'data-id' => $post->id,
                            'class' => 'btn btn-danger btn-lg btn-block',
                            'onclick' => "return confirm('Are you sure?')")) }}
						{{ Form::close() }}
					</div>
					@endif
				</div>
			</div>
		</div>
	</div>
@endsection