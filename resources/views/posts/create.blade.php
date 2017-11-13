@extends('layouts.app')

@section('title', 'Create Post')

@section('content')

    <div class ="row">
        <div class="col-md-8 col-md-offset-2">

            <h1><img class="img img-fluid img-rounded mx-auto" src="{{url('/images/lion.jpg')}}" alt="Image"/>Administrator posts - Create New Post</h1>
            <p>Administrator posts feature stories relevant to dyslexia and how DePaul school has positively helped the students.</p>
			
            <hr>

            {!! Form::open(array('route' => 'posts.store')) !!}
            {{ Form::label('title', 'Post Title:') }}
            {{ Form::text('title', null, array('class' => 'form-control')) }}


            {{ Form::select('alumni', ['Admin' => 'Administrator', 'Alum' => 'Alumni'], 'Admin') }}

            {{ Form::label('body', "Create a desired post regarding news relevant to the school, positive alumni
stories, and feature information.") }}
            {{ Form::textarea('body', null, array('class' => 'form-control' ) ) }}
					

            {{ Form::submit('Enter post into the database', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px;')) }}

			
			<a class="btn btn-primary form-control" href="{{ route('posts.index') }}">{!! Form::close() !!}<p>View All Posts</p></a>
            <a class="btn btn-primary form-control" href="{{ route('home') }}">{!! Form::close() !!}<p>Cancel</p></a>
			
			{!! Form::close() !!}

        </div>
		
    </div>

@endsection