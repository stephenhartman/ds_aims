@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
    <div class ="row">
        <div class="col-md-8 col-md-offset-2">
            <h1><img class="img img-fluid img-rounded mx-auto" src="{{url('/images/lion.jpg')}}" alt="Image"/>Create New Post</h1>
            <hr>

            {!! Form::open(array('route' => 'posts.store')) !!}
            {{ Form::label('title', 'Post Title') }}
            {{ Form::text('title', null, array('class' => 'form-control')) }}
            <br>
            {{ Form::label('alumni', 'Post Category') }}
            {{ Form::select('alumni', ['Admin' => 'Administrator', 'Alum' => 'Alumni'], null, ['placeholder' => 'Pick a post category...', 'class' => 'form-control']) }}
            <br>
            {{ Form::label('body', "Body of post") }}
            {{ Form::textarea('body', null, array('class' => 'form-control' ) ) }}
					
            {{ Form::submit('Submit', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px;')) }}

            {!! Html::linkRoute('posts.index', 'Cancel', array(), array('class' => "btn btn-danger btn-lg btn-block", 'style' => 'margin-top: 20px')) !!}

			{!! Form::close() !!}
        </div>
    </div>
@endsection