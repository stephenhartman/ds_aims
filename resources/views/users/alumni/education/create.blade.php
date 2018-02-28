@extends('layouts.app')

@section('title', 'Add Education Milestone')

@push('scripts')
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>
        tinymce.init ({
            selector: 'textarea',
            height: 200, theme: 'modern',
            plugins: [ 'advlist autolink lists link print preview hr',
                'searchreplace visualblocks visualchars fullscreen',
                'table contextmenu paste textcolor ',
                'colorpicker textpattern help' ],
            toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link ',
            toolbar2: 'print preview media | forecolor backcolor ',
            content_css: ['/css/tinymce.css' ] });
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
                        <h4>Select a milestone to add...</h4>
                        <div class="row">
                            <div class="col-md-5 col-md-offset-1">
                                <a class="btn btn-sm btn-block btn-default" href="{{ route('users.alumni.occupation.create', [$user, $alumnus]) }}"><i class="fa fa-plus-square"></i> Occupation</a>
                            </div>
                            <div class="col-md-5">
                                <a class="btn btn-sm btn-block btn-primary" href="#"><i class="fa fa-plus-square"></i> Education</a>
                            </div>
                        </div>
                        <br>
                        {{ Form::open(['route' => array('users.alumni.education.store', $user, $alumnus)]) }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('type', 'Type of School', ['class' => 'required']) }}
                                    {{ Form::select('type', [
                                    'High School' => 'High School',
                                    'Trade School' => 'Trade School',
                                    'Technical School' => 'Technical School',
                                    'College' => 'College'
                                    ], null, ['class' => 'form-control', 'placeholder' => 'Select a School Type', 'required' => 'required']) }}
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
                                    ], null, ['class' => 'form-control', 'placeholder' => 'Select a Diploma', 'required' => 'required']) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('school', 'Name of School', ['class' => 'required']) }}
                                    {{ Form::text('school', null, ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('location', 'Location (City, State)', ['class' => 'required']) }}
                                    {{ Form::text('location', null, ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('start_year', 'Start Year', ['class' => 'required']) }}
                                    {{ Form::selectYear('start_year', 1980, 2020, Carbon::now()->year, ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('end_year', 'End Year') }}
                                    {{ Form::selectYear('end_year', 1980, 2020, Carbon::now()->year, ['class' => 'form-control', 'required' => 'required']) }}
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
                                    {{ Form::checkbox('share', 1, null, ['class' => 'form-control'] ) }}
                                </div>
                                <div class="col-md-10">
                                    {{ Form::label('share', 'By checking this box, I agree to share this data with the DePaul School and Alumni (Optional)', ['class' => 'checkbox-inline']) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-5">
                                {{ Form::button('<i class="fa fa-save"></i> Submit', ['type' => 'submit', 'class' => 'btn btn-success btn-lg btn-block']) }}
                                {{ Form::close() }}
                            </div>
                            <div class="col-md-5">
                                <a href="{{ url()->previous() }}" class="btn btn-warning btn-lg btn-block"><span class="fa fa-ban"></span> Cancel</a>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
