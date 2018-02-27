@extends('layouts.app')

@section('title', 'Edit Occupation Milestone')

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#form-delete').submit(function (event) {
                event.preventDefault();
                swal({
                    title: "Delete this occupation milestone?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if(willDelete) {
                        swal("Milestone deleted.", {
                            icon: "success",
                        });
                        $("#form-delete").off("submit").submit();
                    }
                });
            });
        });
    </script>
@endpush

@push('scripts')
    <script src="https://cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>
        tinymce.init ({
            selector: 'textarea',
            height: 200, theme: 'modern',
            plugins: [ 'advlist autolink lists link print preview hr',
                'searchreplace visualblocks visualchars  fullscreen',
                'table contextmenu emoticons paste textcolor ',
                'colorpicker textpattern help' ],
            branding: false,
            toolbar1: 'undo redo | styleselect | bold italic underline superscript subscript | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent |',
            toolbar2: 'print preview | link | emoticons',
            block_formats: 'Paragraph=p;Header 1=h1;Header 2=h2;Header 3=h3;Header 4=h4;Header5=h5;Header6=h6;Horizontal Line=hr;',
            style_formats: [
                { title: 'Headers', items: [
                        { title: 'Heading 1', block: 'h1' },
                        { title: 'Heading 2', block: 'h2' },
                        { title: 'Heading 3', block: 'h3' },
                        { title: 'Heading 4', block: 'h4' },
                        { title: 'Heading 5', block: 'h5' },
                        { title: 'Heading 6', block: 'h6' }
                    ] },
            ],
            relative_urls: false,
            content_css: ['/css/tinymce.css'] });
    </script>
@endpush
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Milestones</h4>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <h4>Select a milestone to add...</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 col-md-offset-1">
                                <a class="btn btn-sm btn-block btn-primary" href="#">Occupation</a>
                            </div>
                            <div class="col-md-5">
                                <a class="btn btn-sm btn-block btn-default" href="{{ route('users.alumni.education.create', [$user, $alumnus]) }}">Education</a>
                            </div>
                        </div>
                        <br>
                        {{ Form::model($occupation, ['route' => array('users.alumni.occupation.update', $user, $alumnus, $occupation), 'method' => 'PATCH']) }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('organization', 'Company Name', ['class' => 'required']) }}
                                    {{ Form::text('organization', null, ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('position', 'Job Title', ['class' => 'required']) }}
                                    {{ Form::text('position', null, ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('start_year', 'Start Year', ['class' => 'required']) }}
                                    {{ Form::selectYear('start_year', 1980, 2020, $occupation->start_year, ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('end_year', 'End Year') }}
                                    {{ Form::selectYear('end_year', 1980, 2020, $occupation->end_year, ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                {{ Form::label('testimonial', 'How did DePaul prepare you for continued learning?') }}
                                {{ Form::textarea('testimonial', null, array('class' => 'form-control' ) ) }}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-2">
                                    {{ Form::checkbox('share', $occupation->share == 1 ? true : null, null, ['class' => 'form-control'] ) }}
                                </div>
                                <div class="col-md-10">
                                    {{ Form::label('share', 'By checking this box, I agree to share this data with the DePaul School and Alumni (Optional)') }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                {{ Form::button('<i class="fa fa-save"></i> Save', ['type' => 'submit', 'class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top:20px;']) }}
                                {{ Form::close() }}
                            </div>
                            <div class="col-md-4">
                                <a href="{{ url()->previous() }}" class="btn btn-warning btn-lg btn-block" style="margin-top: 20px;"><span class="fa fa-ban"></span> Cancel</a>
                            </div>
                            <div class="col-md-4">
                                {{ Form::open(['route' => ['users.alumni.occupation.destroy', $user, $alumnus, $occupation], 'method' => 'DELETE', 'id' => 'form-delete']) }}
                                {{ Form::button('<i class="fa fa-trash"></i> Delete', array(
                                    'type' => 'submit',
                                    'data-id' => $occupation->id,
                                    'class' => 'btn btn-danger btn-lg btn-block',
                                    'style' => 'margin-top: 20px;')) }}
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
