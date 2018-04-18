<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-6">
                <h4>Edit Profile Photo</h4>
            </div>
            <div class="col-md-4 col-md-offset-2">
                @if ($alumnus->photo_url !== null)
                    <a href="{{ route('photo_delete', array($user, $alumnus)) }}" class="btn btn-danger btn-block" id="photo-delete"><i class="fa fa-trash"></i> Delete Photo</a>
                @endif
            </div>
        </div>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4 text-center">
                <figure class="figure">
                    @if ($alumnus->photo_url !== null)
                        <img class="img-thumbnail img-responsive" src="{{ url($alumnus->photo_url) }}">
                        <figcaption class="figure-caption">Current Profile Photo</figcaption>
                    @endif
                </figure>
            </div>
            <div class="col-sm-4"></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('photo_url', 'Upload a different profile picture') }}
                    {{ Form::file('photo_url', ['accept' => 'image/*', 'onchange' => "document.getElementById('output').src = window.URL.createObjectURL(this.files[0])"], array('class' => 'form-control')) }}
                </div>
            </div>
        </div>
    </div>
</div>
