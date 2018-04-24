@extends('layouts.app')

@section('title', 'Edit Photo')

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#form-delete').submit(function (event) {
                event.preventDefault();
                swal({
                    title: "Delete this photo?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if(willDelete) {
                        swal("The photo has been deleted.", {
                            icon: "success",
                        });
                        $("#form-delete").off("submit").submit();
                    }
                });
            });
            $('#output').on('load', function () {
                $('#output').promise().done(function() {
                    $("#photoModal").modal('show');
                });
            });
        });
    </script>
@endpush

@section('content')
    <div class="container">
        <div class ="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>Edit Photo</h2>
                    </div>
                    <div class="panel-body">
                        {!! Form::model($photo, ['route' => ['photos.update', $photo], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
                        <div class="row">
                            <div class="col-md-5">
                                <figure class="figure">
                                    @if ($photo->photo_url !== null)
                                        <img class="img-thumbnail img-responsive" src="{{ url($photo->photo_url) }}">
                                    @endif
                                </figure>
                            </div>
                            <div class="col-md-7">
                                {{ Form::label('photo_url', 'Upload New Photo (No Larger than 5 MB)') }}
                                {{ Form::file('photo_url', ['accept' => 'image/*', 'onchange' => "document.getElementById('output').src = window.URL.createObjectURL(this.files[0])"], array('class' => 'form-control')) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                {{ Form::label('caption', "Photo Caption (Maximum 500 characters)") }}
                                {{ Form::textarea('caption', $photo->caption , array('class' => 'form-control', 'maxlength' => '500')) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                {{ Form::button('<i class="fa fa-save"></i> Save Changes', ['type' => 'submit', 'class' => 'btn btn-success btn-lg btn-block']) }}
                                {{ Form::close() }}
                            </div>
                            <div class="col-md-4">
                                <a href="{{ action('PhotoController@index') }}" class="btn btn-warning btn-lg btn-block">
                                    <span class="fa fa-ban"></span> Cancel
                                </a>
                            </div>
                            <div class="col-md-4">
                                {{ Form::open(['route' => ['photos.destroy', $photo], 'method' => 'DELETE', 'id' => 'form-delete']) }}
                                {{ Form::button('<i class="fa fa-trash"></i> Delete', array(
                                    'type' => 'submit',
                                    'data-id' => $photo->id,
                                    'class' => 'btn btn-danger btn-lg btn-block' )) }}
                                {{ Form::close() }}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <div id="photoModal" class="modal fade">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><i class="fa fa-window-close"></i></span> <span class="sr-only">close</span></button>
                        <h4 class="modal-title">Photo Preview</h4>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <img class="img img-responsive" id="output" width="auto" height="500px" style="margin:auto">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-lg btn-block" data-dismiss="modal"><i class="fa fa-window-close"></i> Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
