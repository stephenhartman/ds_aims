@extends('layouts.app')

@section('title', 'Create Post')

@push('scripts')
	<script src="https://cdn.tinymce.com/4/tinymce.min.js"></script>
	<script>
		tinymce.init ({
            selector: 'textarea',
            height: 500, theme: 'modern',
            plugins: [ 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc' ],
            branding: false,
            toolbar1: 'undo redo | styleselect | bold italic underline superscript subscript | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent |',
            toolbar2: 'print preview | link image | emoticons',
            style_formats: [
                { title: 'Headers', items: [
                        { title: 'Heading 1', block: 'h1' },
                        { title: 'Heading 2', block: 'h2' },
                        { title: 'Heading 3', block: 'h3' },
                        { title: 'Heading 4', block: 'h4' },
                        { title: 'Heading 5', block: 'h5' },
                        { title: 'Heading 6', block: 'h6' }
                    ] },
                { title: 'Image', items: [
                        {title: 'Image Left', selector: 'img', styles: {
                                'float' : 'left',
                                'margin': '0 10px 0 10px'
                            }},
                        {title: 'Image Right', selector: 'img', styles: {
                                'float' : 'right',
                                'margin': '0 10px 0 10px'
                            }}
                    ]}
            ],
            relative_urls: false,
            file_browser_callback: function(field_name, url, type, win) {
                // trigger file upload form
                if (type == 'image')
                    $('#formUpload').find('input').click();
            },
            img_advtab: true,
            content_css: ['/css/tinymce.css'] });
	</script>
    @include('mceImageUpload::upload_form')
@endpush

@section('content')
    <div class="container">
        <div class ="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>Create Post</h2>
                    </div>
                    <div class="panel-body">
                        {!! Form::open(array('route' => 'posts.store', 'data-parsley-validate' => '', 'files' => true)) !!}
                        <div class="row">
                            <div class="col-md-6">
                                {{ Form::label('title', 'Post Title') }}
                                {{ Form::text('title', null, array('class' => 'form-control')) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                {{ Form::label('body', "Post Body") }}
                                {{ Form::textarea('body', null, array('class' => 'form-control' ) ) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-md-offset-2">
                                {{ Form::submit('Submit', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px;')) }}
                            </div>
                            <div class="col-md-4">
                                {!! Html::linkRoute('posts.index', 'Cancel', array(), array('class' => "btn btn-danger btn-lg btn-block", 'style' => 'margin-top: 20px')) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
