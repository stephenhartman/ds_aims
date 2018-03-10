@extends('layouts.app')

@section('title', 'Create Photo')

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
                                {{ Form::label('photo_url', 'Upload New Photo') }}
                                {{ Form::file('photo_url', ['accept' => 'image/*'], array('class' => 'form-control', 'id' => 'uploadFile')) }}
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
    </div>
@endsection
