<div class="panel panel-default">
    <div class="panel-heading">
        <h4>Edit Profile</h4>
    </div>
    <div class="panel-body">
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
                    {{ Form::text('first_name', null, ['class' => 'form-control', 'required' => 'required']) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('last_name', 'Last Name', ['class' => 'required']) }}
                    {{ Form::text('last_name', null, ['class' => 'form-control', 'required' => 'required']) }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    {{ Form::checkbox('loyal_lion', $alumnus->loyal_lion == 1 ? true : null, null, ['class' => 'form-control'] ) }}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('loyal_lion', 'Would you like to sign up for the Loyal Lion Program?') }}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    {{ Form::checkbox('volunteer', $alumnus->volunteer == 1 ? true : null, null, ['class' => 'form-control'] ) }}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('volunteer', 'Would you like to volunteer for the DePaul School?') }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    {{ Form::checkbox('is_parent', $alumnus->is_parent == 1 ? true : null, null, ['class' => 'form-control', 'id' => 'parent'] ) }}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('is_parent', 'Check this box if you are a parent') }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('year_graduated', 'Year you graduated from the DePaul School') }}
                    {{ Form::selectYear('year_graduated', 1980, 2025, $alumnus->year_graduated, ['class' => 'form-control'] ) }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('social_pref', 'Social Media Preference') }}
                    <div class="row">
                        <div class="col-xs-3">
                            {{ Form::checkbox('facebook', $alumnus->facebook == 1 ? true : null, null, ['class' => 'form-control']) }}
                        </div>
                        <div class="col-xs-9">
                            {{ Form::label('facebook', 'Facebook', ['style' => 'margin-top:12px']) }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-3">
                            {{ Form::checkbox('twitter', $alumnus->twitter == 1 ? true : null, null, ['class' => 'form-control']) }}
                        </div>
                        <div class="col-xs-9">
                            {{ Form::label('twitter', 'Twitter', ['style' => 'margin-top:12px']) }}
                        </div>
                        </label>
                    </div>
                    <div class="row">
                        <div class="col-xs-3">
                            {{ Form::checkbox('instagram', $alumnus->instagram == 1 ? true : null, null, ['class' => 'form-control']) }}
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
                    $alumnus->state, ['class' => 'form-control']) }}
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
            <div class="col-md-3">
                <div class="form-group">
                    {{ Form::button('<i class="fa fa-save"></i> Save', ['type' => 'submit', 'class' => 'btn btn-success btn-lg btn-block']) }}
                    {{ Form::close() }}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <a href="{{ action('HomeController@index') }}" class="btn btn-warning btn-lg btn-block">
                        <span class="fa fa-ban"></span> Cancel
                    </a>
                </div>
            </div>
            <div class="text-center col-md-6">
                <h5>
                    A <span class="required"></span>
                    indicates a required field.</h5>
            </div>
        </div>
    </div>
</div>
