@extends('layouts.app')

@section('title', 'Create Post')




	{!! Html::style('css/parsley.css') !!}
	{!! Html::style('css/select2.min.css') !!}
	<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

	<script>
		tinymce.init ({ selector: 'textarea', height: 500, theme: 'modern', plugins: [ 'advlist autolink lists link image charmap print preview hr anchor pagebreak', 'searchreplace wordcount visualblocks visualchars code fullscreen', 'insertdatetime media nonbreaking save table contextmenu directionality', 'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc' ], toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image', toolbar2: 'print preview media | forecolor backcolor emoticons | codesample', image_advtab: true, templates: [ { title: 'Test template 1', content: 'Test 1' }, { title: 'Test template 2', content: 'Test 2' } ], content_css: [ '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i', '//www.tinymce.com/css/codepen.min.css' ] });﻿
	</script>



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