<div class="panel panel-default">
    <div class="panel-heading">
        <h4>Edit Email</h4>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="form-group">
                    {{ Form::label('email', 'Email Address', ['class' => 'required']) }}
                    {{ Form::text('email', null, ['class' => 'form-control', 'required' => 'required']) }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                {{ Form::button('<i class="fa fa-save"></i> Save Email Address', ['type' => 'submit', 'class' => 'btn btn-success btn-lg btn-block']) }}
            </div>
        </div>
    </div>
</div>
