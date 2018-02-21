<div class="panel panel-default">
    <div class="panel-heading">
        <h4>Edit Profile Photo</h4>
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
                    {{ Form::file('photo_url', ['accept' => 'image/*']) }}
                </div>
            </div>
        </div>
    </div>
</div>
