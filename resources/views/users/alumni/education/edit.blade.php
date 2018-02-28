@extends('layouts.app')

@section('title', 'Edit Education Milestone')

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#form-delete').submit(function (event) {
                event.preventDefault();
                swal({
                    title: "Delete this education milestone?",
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
                            <div class="col-md-5 col-md-offset-1">
                                <a class="btn btn-sm btn-block btn-default" href="{{ route('users.alumni.occupation.create', [$user, $alumnus]) }}">Occupation</a>
                            </div>
                            <div class="col-md-5">
                                <a class="btn btn-sm btn-block btn-primary" href="#">Education</a>
                            </div>
                        </div>
                        <br>
                        {{ Form::model($education, ['route' => array('users.alumni.education.update', $user, $alumnus, $education), 'method' => 'PATCH']) }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('type', 'Type of School', ['class' => 'required']) }}
                                    {{ Form::select('type', [
                                    'High School' => 'High School',
                                    'Trade School' => 'Trade School',
                                    'Technical School' => 'Technical School',
                                    'College' => 'College'
                                    ], null, ['class' => 'form-control', 'placeholder' => 'Select a School Type']) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('diploma', 'Diploma Received', ['class' => 'required']) }}
                                    {{ Form::select('diploma', [
                                    'GED' => 'GED',
                                    'High School Diploma' => 'High School Diploma',
                                    'Certification' => 'Certification',
                                    'Associate\'s Degree' => 'Associate\'s Degree',
                                    'Bachelor\'s Degree' => 'Bachelor\'s Degree',
                                    'Post Graduate Degree' => 'Postgraduate Degree'
                                    ], null, ['class' => 'form-control', 'placeholder' => 'Select a Diploma']) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('school', 'Name of School', ['class' => 'required']) }}
                                    {{ Form::text('school', null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('location', 'Location (City, State)', ['class' => 'required']) }}
                                    {{ Form::text('location', null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('start_year', 'Start Year', ['class' => 'required']) }}
                                    {{ Form::selectYear('start_year', 1980, 2020, Carbon::now()->year, ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('end_year', 'End Year') }}
                                    {{ Form::selectYear('end_year', 1980, 2020, Carbon::now()->year, ['class' => 'form-control']) }}
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
                                <div class="col-md-1 col-md-offset-1">
                                    {{ Form::checkbox('share',  $education->share == 1 ? true : null, null, ['class' => 'form-control'] ) }}
                                </div>
                                <div class="col-md-10">
                                    {{ Form::label('share', 'By checking this box, I agree to share this data with the DePaul School and Alumni (Optional)', ['class' => 'checkbox-inline']) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                {{ Form::button('<i class="fa fa-save"></i> Save', ['type' => 'submit', 'class' => 'btn btn-success btn-lg btn-block']) }}
                                {{ Form::close() }}
                            </div>
                            <div class="col-md-4">
                                <a href="{{ url()->previous() }}" class="btn btn-warning btn-lg btn-block"><span class="fa fa-ban"></span> Cancel</a>
                            </div>
                            <div class="col-md-4">
                                {{ Form::open(['route' => ['users.alumni.education.destroy', $user, $alumnus, $education], 'method' => 'DELETE', 'id' => 'form-delete']) }}
                                {{ Form::button('<i class="fa fa-trash"></i> Delete', array(
                                    'type' => 'submit',
                                    'data-id' => $education->id,
                                    'class' => 'btn btn-danger btn-lg btn-block')) }}
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
