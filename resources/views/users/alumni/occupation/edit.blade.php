@extends('layouts.app')

@section('title', 'Edit Occupation Milestone')

@push('styles')
    {!! Html::style('css/parsley.css') !!}
    {!! Html::style('css/select2.min.css') !!}
@endpush

@push('scripts')
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>
        tinymce.init ({
            selector: 'textarea',
            height: 200, theme: 'modern',
            toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            toolbar2: 'print preview media | forecolor backcolor emoticons | codesample',
            image_advtab: true,
            templates: [ { title: 'Test template 1', content: 'Test 1' },
                { title: 'Test template 2', content: 'Test 2' } ],
            content_css: ['//www.tinymce.com/css/codepen.min.css' ] });
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
                            <div class="col-md-12">
                                {{ Form::label('share', 'By checking this box, I agree to share this data with the DePaul School and Alumni (Optional)') }}
                                {{ Form::checkbox('share', $occupation->share == 1 ? true : null, null, ['class' => 'form-control'] ) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                {{ Form::submit('Submit', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px;')) }}
                                {{ Form::close() }}
                            </div>
                            <div class="col-md-4">
                                <a href="{{ url()->previous() }}" class="btn btn-warning btn-lg btn-block" style="margin-top: 20px;">Cancel</a>
                            </div>
                            <div class="col-md-4">
                                {{ Form::open(['route' => ['users.alumni.occupation.destroy', $user, $alumnus, $occupation], 'method' => 'DELETE']) }}
                                {{ Form::button('Delete', array(
                                    'type' => 'submit',
                                    'data-id' => $occupation->id,
                                    'class' => 'btn btn-danger btn-lg btn-block',
                                    'style' => 'margin-top: 20px;',
                                    'onclick' => "return confirm('Are you sure?')")) }}
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection