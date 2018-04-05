@extends('layouts.app')

@section('title', 'Alumni Demographic Form')

@push('scripts')
    <script>
        $(document).ready(function(){
            if($('#parent').is(':checked'))
            {
                $('#parent_name_label').show();
                $('#parent_name').show();
            }
            $('#parent').on('change', function(){
                $('#parent_name_label').toggle(this.checked);
                $('#parent_name').toggle(this.checked);
            })
        });
        $("#photo_url").change(function(){
            $("#photoModal").show();
        });
    </script>
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Create Alumni Account</h4>
                    </div>
                    <div class="panel-body">
                        {{ Form::open(['route' => array('users.alumni.store', $user), 'enctype' => 'multipart/form-data']) }}
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-2">
                                    {{ Form::checkbox('is_parent', 1, null, ['id' => 'parent', 'class' => 'checkbox-inline'] ) }}
                                    {{ Form::label('is_parent', 'Check this box if you are a parent signing up for your child', ['class' => 'checkbox-inline', 'style' => 'font-weight:800']) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{Form::label ('parent_name', 'Parent Name', ['id' => 'parent_name_label', 'style' => 'display:none'])}}
                                    {{Form::text('parent_name', null, ['id' => 'parent_name', 'class' => 'form-control', 'style' => 'display:none'])}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('first_name', 'First Name', ['class' => 'required']) }}
                                    {{ Form::text('first_name', $user->firstName(), ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('last_name', 'Last Name', ['class' => 'required']) }}
                                    {{ Form::text('last_name', $user->lastName(), ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('photo_url', 'Upload a profile picture') }}
                                    {{ Form::file('photo_url', ['accept' => 'image/*', 'onchange' => "document.getElementById('output').src = window.URL.createObjectURL(this.files[0])", 'data-toggle' => "modal", 'data-target' => "#photoModal"], array('class' => 'form-control')) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('year_graduated', 'Year you graduated from the DePaul School') }}
                                    {{ Form::selectYear('year_graduated', 1980, 2025, Carbon::now()->year, ['class' => 'form-control'] ) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('social_pref', 'Social Media Preference') }}
                                    <div class="row">
                                        <div class="col-xs-3">
                                            {{ Form::checkbox('facebook', 1, null, ['class' => 'form-control']) }}
                                        </div>
                                        <div class="col-xs-9">
                                            {{ Form::label('facebook', 'Facebook', ['style' => 'margin-top:12px']) }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-3">
                                            {{ Form::checkbox('twitter', 1, null, ['class' => 'form-control']) }}
                                        </div>
                                        <div class="col-xs-9">
                                            {{ Form::label('twitter', 'Twitter', ['style' => 'margin-top:12px']) }}
                                        </div>
                                        </label>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-3">
                                            {{ Form::checkbox('instagram', 1, null, ['class' => 'form-control']) }}
                                        </div>
                                        <div class="col-xs-9">
                                            {{ Form::label('instagram', 'Instagram', ['style' => 'margin-top:12px']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('phone_number', 'Phone Number') }}
                                    {{ Form::tel('phone_number', null, ['class' => 'form-control', 'placeholder' => '(XXX) XXX-XXXX']) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('street_address', 'Street Address') }}
                                    {{ Form::text('street_address', null, ['class' => 'form-control', 'placeholder' => '123 State St.']) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('city', 'City') }}
                                    {{ Form::text('city', null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('state', 'State') }}
                                    {{ Form::select('state', [
                                    null => 'Select a State',
                                    'AL'=>'Alabama',
                                    'AK'=>'Alaska',
                                    'AZ'=>'Arizona',
                                    'AR'=>'Arkansas',
                                    'CA'=>'California',
                                    'CO'=>'Colorado',
                                    'CT'=>'Connecticut',
                                    'DE'=>'Delaware',
                                    'DC'=>'District of Columbia',
                                    'FL'=>'Florida',
                                    'GA'=>'Georgia',
                                    'HI'=>'Hawaii',
                                    'ID'=>'Idaho',
                                    'IL'=>'Illinois',
                                    'IN'=>'Indiana',
                                    'IA'=>'Iowa',
                                    'KS'=>'Kansas',
                                    'KY'=>'Kentucky',
                                    'LA'=>'Louisiana',
                                    'ME'=>'Maine',
                                    'MD'=>'Maryland',
                                    'MA'=>'Massachusetts',
                                    'MI'=>'Michigan',
                                    'MN'=>'Minnesota',
                                    'MS'=>'Mississippi',
                                    'MO'=>'Missouri',
                                    'MT'=>'Montana',
                                    'NE'=>'Nebraska',
                                    'NV'=>'Nevada',
                                    'NH'=>'New Hampshire',
                                    'NJ'=>'New Jersey',
                                    'NM'=>'New Mexico',
                                    'NY'=>'New York',
                                    'NC'=>'North Carolina',
                                    'ND'=>'North Dakota',
                                    'OH'=>'Ohio',
                                    'OK'=>'Oklahoma',
                                    'OR'=>'Oregon',
                                    'PA'=>'Pennsylvania',
                                    'RI'=>'Rhode Island',
                                    'SC'=>'South Carolina',
                                    'SD'=>'South Dakota',
                                    'TN'=>'Tennessee',
                                    'TX'=>'Texas',
                                    'UT'=>'Utah',
                                    'VT'=>'Vermont',
                                    'VA'=>'Virginia',
                                    'WA'=>'Washington',
                                    'WV'=>'West Virginia',
                                    'WI'=>'Wisconsin',
                                    'WY'=>'Wyoming',
                                    ],
                                    null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('zipcode', 'Zip Code') }}
                                    {{ Form::text('zipcode', null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-4 text-center">
                                {{ Form::button('<i class="fa fa-save"></i> Submit', ['type' => 'submit', 'class' => 'btn btn-success btn-lg btn-block']) }}
                                {{ Form::close() }}
                            </div>
                            <div class="col-md-1"></div>
                            <div class="text-center col-md-6">
                                <h5>
                                    A <span class="required"></span>
                                    indicates a required field.
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="photoModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><i class="fa fa-window-close"></i></span> <span class="sr-only">close</span></button>
                        <h4 class="modal-title">Photo Preview</h4>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <img id="output" width="320px" height="auto" style="margin:auto">
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
