@extends('layouts.app')

@section('title', 'Alumni Demographic Form')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Create Alumni Account</h4>
                    </div>
                    <div class="panel-body">
                        {{ Form::open(['route' => array('users.alumni.store', $user)]) }}
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
                                    {{ Form::label('social_pref', 'Social Media Preference') }}
                                    {{ Form::select('social_pref', [
                                    'Facebook' => 'Facebook',
                                    'Twitter' => 'Twitter',
                                    'Instagram' => 'Instagram'],
                                     null, ['class' => 'form-control', 'placeholder' => 'Select a Social Media Preference']) }}
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
                                <div class="col-md-3">
                                    {{ Form::submit('Submit', ['class' => 'btn btn-lg btn-success btn-block']) }}
                                    {{ Form::close() }}
                                </div>
                                <div class="col-md-3">
                                    {!! Html::linkRoute('home', 'Cancel', array(), array('class' => "btn btn-warning btn-lg btn-block", 'onclick' => "return confirm('Are you sure you want to cancel account creation?')")) !!}
                                </div>
                                <div class="text-center col-md-6">
                                    <h5>
                                        A <span class="required"></span>
                                        indicates a required field.</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
@endsection
