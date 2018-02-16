@extends('layouts.app')

@section('title', 'Create Post')

@push('styles')
	{!! Html::style('css/parsley.css') !!}
	{!! Html::style('css/select2.min.css') !!}
@endpush

@push('scripts')
	<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
	<script>
		tinymce.init ({
            selector: 'textarea',
            height: 500, theme: 'modern',
            plugins: [ 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc' ],
            toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            toolbar2: 'print preview media | forecolor backcolor emoticons | codesample',
           
			        relative_urls: false,
        file_browser_callback: function(field_name, url, type, win) {
            // trigger file upload form
            if (type == 'image') $('#formUpload input').click();
        },



		   image_advtab: true,
            templates: [ { title: 'Test template 1', content: 'Test 1' },
                { title: 'Test template 2', content: 'Test 2' } ],
            content_css: ['//www.tinymce.com/css/codepen.min.css' ] });
	</script>
@endpush

@section('content')
    <div class ="row">
        <div class="col-md-8 col-md-offset-2">
            <h1><img class="img img-fluid img-rounded mx-auto" src="{{url('/images/lion.jpg')}}" alt="Image"/>Create New Post</h1>
            <hr>
			{!! Form::open(array('route' => 'posts.store', 'data-parsley-validate' => '', 'files' => true)) !!}

            {{ Form::label('title', 'Post Title') }}
            {{ Form::text('title', null, array('class' => 'form-control')) }}
            <br>
            {{ Form::label('alumni', 'Post Category') }}
            {{ Form::select('alumni', ['Admin' => 'Administrator', 'Alumnus' => 'Alumni'], null, ['placeholder' => 'Pick a post category...', 'class' => 'form-control']) }}
            <br>
			{{ Form::label('featured_img', 'Upload an image to DePaul') }}
			{{ Form::file('featured_img') }}
			
            {{ Form::label('body', "Body of post") }}
            {{ Form::textarea('body', null, array('class' => 'form-control' ) ) }}
					
		
					
            {{ Form::submit('Submit', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px;')) }}

            {!! Html::linkRoute('posts.index', 'Cancel', array(), array('class' => "btn btn-danger btn-lg btn-block", 'style' => 'margin-top: 20px')) !!}

			{!! Form::close() !!}
        </div>
    </div>
@endsection
@include('mceImageUpload::upload_form')

