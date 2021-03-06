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
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>
        tinymce.init ({
            selector: 'textarea',
            height: 200, theme: 'modern',
            plugins: [ 'advlist autolink lists link print preview hr',
                'visualblocks visualchars fullscreen',
                'contextmenu paste textcolor ',
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
                            <div class="col-md-6 col-md-offset-3">
                                <div class="form-group">
                                    {{ Form::label('type', 'Type of Occupation', ['class' => 'required']) }}
                                    {{ Form::select('type', [
                                    'Administrative' => 'Administrative',
                                    'Commercial' => 'Commercial',
                                    'Professional' => 'Professional'],
                                    $occupation->type, ['class' => 'form-control', 'placeholder' => 'Select an Occupation Type', 'required' => 'required']) }}
                                </div>
                            </div>
                        </div>
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
                                    {{ Form::selectYear('start_year', 1980, 2025, $occupation->start_year, ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('end_year', 'End Year') }}
                                    {{ Form::selectYear('end_year', 1980, 2025, $occupation->end_year, ['class' => 'form-control', 'required' => 'required']) }}
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
                                    {{ Form::checkbox('share', $occupation->share == 1 ? true : null, null, ['class' => 'form-control'] ) }}
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
                                {{ Form::open(['route' => ['users.alumni.occupation.destroy', $user, $alumnus, $occupation], 'method' => 'DELETE', 'id' => 'form-delete']) }}
                                {{ Form::button('<i class="fa fa-trash"></i> Delete', array(
                                    'type' => 'submit',
                                    'data-id' => $occupation->id,
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
