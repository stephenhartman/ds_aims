@extends('layouts.app')

@section('title', '| Edit DePaul Administrator Post')

@section('content')




	<div class="row">
		{!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'PUT']) !!}

<table>
		<tbody><tr>
			<th>		<div class="col-md-16">
			{{ Form::label('title', 'Title:') }}
			{{ Form::text('title', null, ["class" => 'form-control input-lg']) }}
			
			{{ Form::label('body', "Body:", ['class' => 'form-spacing-top']) }}
			{{ Form::textarea('body', null, ['class' => 'form-control']) }}
		</div></th>
		
		</tr>
		<tr>
			<td>		<div class="col-md-16">
			<div class="well">
				
				<hr>
				<div class="row">
					<div class="col-sm-6">
						{!! Html::linkRoute('posts.show', 'Cancel', array($post->id), array('class' => 'btn btn-danger btn-block')) !!}
					</div>
					<div class="col-sm-6">
						{{ Form::submit('Save Changes', ['class' => 'btn btn-success btn-block']) }}
					</div>
				</div>

			</div>
		</div></td>
		
		
		
		</tr>
		<tr>
			
		</tr>
		
		
	</tbody></table>

		{!! Form::close() !!}
	</div>	

@stop