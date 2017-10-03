@extends('home')

@section('title', 'Create Post')

@section('content')

    <div class ="row">
        <div class="col-md-8 col-md-offset-2">


            <h1><img class="img img-fluid img-rounded mx-auto" src="{{url('/images/lion.jpg')}}" alt="Image"/>Volunteer information - Create New Post</h1>
            <p>You may enter a description of what the volunteer is donating to the school</p>
            <hr>

            {!! Form::open(array('route' => 'posts.store')) !!}
            {{ Form::label('title', 'Volunteer Title:') }}
            {{ Form::text('title', null, array('class' => 'form-control')) }}


            {{ Form::select('alumni', ['Admin' => 'Administrator', 'Alum' => 'Alumni'], 'Alum') }}

            {{ Form::label('body', "How would you like to help DePaul school?:") }}
            {{ Form::textarea('body', null, array('class' => 'form-control' ) ) }}


            {{ Form::label('donation', "Description of volunteer activity or donation:") }}
            {{ Form::textarea('donation', null, array('class' => 'form-control' ) ) }}

            {{ Form::submit('Enter post into the database', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px;'     )) }}

            {!! Form::close() !!}

        </div>
    </div>

@endsection
