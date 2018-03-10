@extends('layouts.app')

@section('title', 'Create Photo')

@section('content')
    <div class="container">
        <div class ="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>Create Photo</h2>
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['route' => ['photos.store'], 'enctype' => 'multipart/form-data']) !!}
                        <div class="row">
                            <div class="col-md-12">
                                {{ Form::label('photo_url', 'Upload Photo') }}
                                {{ Form::file('photo_url', ['accept' => 'image/*'], array('class' => 'form-control', 'id' => 'uploadFile')) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                {{ Form::label('caption', "Photo Caption (Maximum 500 characters)") }}
                                {{ Form::textarea('caption', null, array('class' => 'form-control', 'maxlength' => '500')) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-md-offset-2">
                                {{ Form::button('<i class="fa fa-save"></i> Submit', ['type' => 'submit', 'class' => 'btn btn-success btn-lg btn-block']) }}
                                {{ Form::close() }}
                            </div>
                            <div class="col-md-4">
                                <a href="{{ action('PhotoController@index') }}" class="btn btn-warning btn-lg btn-block">
                                    <span class="fa fa-ban"></span> Cancel
                                </a>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
