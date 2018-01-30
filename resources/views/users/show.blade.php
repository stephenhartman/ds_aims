@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Create Alumni Account</h4>
                    </div>
                    <div class="panel-body">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <td>First Name</td>
                    <td>Last Name</td>
                    <td>Email</td>
                    <td>Username</td>
                    <td>Street</td>
                    <td>City</td>
                    <td>State</td>
                    <td>Zipcode</td>
                    <td>Home Phone</td>
                    <td>Work Phone</td>
                    <td>Cell Phone</td>
                    <td>License?</td>
                    <td>SS Card?</td>
                    <td>Approval Status</td>
                    <td></td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{ $member->first_name }}</td>
                    <td>{{ $member->last_name }}</td>
                    <td>{{ Html::mailto($member->email) }}</td>
                    <td>{{ $member->username }}</td>
                    <td>{{ $member->street }}</td>
                    <td>{{ $member->city }}</td>
                    <td>{{ $member->state }}</td>
                    <td>{{ $member->zipcode }}</td>
                    <td>{{ $member->home_phone }}</td>
                    <td>{{ $member->work_phone }}</td>
                    <td>{{ $member->cell_phone }}</td>
                    @if ($member->drivers_license == 1 )
                        <td>Yes</td>
                    @else
                        <td>No</td>
                    @endif
                    @if ($member->ss_card == 1 )
                        <td>Yes</td>
                    @else
                        <td>No</td>
                    @endif
                    <td>{{ ucfirst($member->approval_status) }}</td>
                    <td>
                        <div class="row">
                            <div class="col-md-12">
                                {{ Form::open(['method' => 'GET', 'route' => ['members.edit', $member->id]]) }}
                                {{ Form::button('<i class="glyphicon glyphicon-pencil"></i> Edit', array('type' => 'submit', 'class' => 'btn btn-warning')) }}
                                {{ Form::close() }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                {{ Form::open(['method' => 'DELETE', 'route' => ['members.destroy', $member->id], ]) }}
                                {{ Form::button('<i class="glyphicon glyphicon-trash"></i> Delete', array('type' => 'submit', 'data-id' => $member->id, 'class' => 'btn btn-danger delete-member', 'onclick' => "return confirm('Are you sure?')")) }}
                                {{ Form::close() }}
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-md-3">
            <h3>Emergency Contacts</h3>
        </div>
        <div class="col-md-3 col-md-offset-3">
            <a href="{{ route('members.emergency_contacts.create', $member->id) }}" class="btn btn-block btn-primary" style="margin-top: 18px">New Contact</a>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <td>First Name</td>
                    <td>Last Name</td>
                    <td>Email</td>
                    <td>Street</td>
                    <td>City</td>
                    <td>State</td>
                    <td>Zipcode</td>
                    <td>Home Phone</td>
                    <td>Work Phone</td>
                    <td>Cell Phone</td>
                    <td id="borderless"></td>
                </tr>
                </thead>
                <tbody>
                @foreach ($member->emergency_contacts as $contact)
                    <tr>
                        <td>{{ $contact->first_name }}</td>
                        <td>{{ $contact->last_name }}</td>
                        <td>{{ Html::mailto($contact->email) }}</td>
                        <td>{{ $contact->street }}</td>
                        <td>{{ $contact->city }}</td>
                        <td>{{ $contact->state }}</td>
                        <td>{{ $contact->zipcode }}</td>
                        <td>{{ $contact->home_phone }}</td>
                        <td>{{ $contact->work_phone }}</td>
                        <td>{{ $contact->cell_phone }}</td>
                        <td>
                            <div class="row">
                                <div class="col-md-12">
                                    {{ Form::open(['method' => 'GET', 'route' => ['members.emergency_contacts.edit', $member, $contact]]) }}
                                    {{ Form::button('<i class="glyphicon glyphicon-pencil"></i> Edit', array('type' => 'submit', 'class' => 'btn btn-warning')) }}
                                    {{ Form::close() }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    {{ Form::open(['method' => 'DELETE', 'route' => ['members.emergency_contacts.destroy', $member, $contact]]) }}
                                    {{ Form::button('<i class="glyphicon glyphicon-trash"></i> Delete', array('type' => 'submit', 'data-id' => $contact->id, 'class' => 'btn btn-danger delete-member', 'onclick' => "return confirm('Are you sure?')")) }}
                                    {{ Form::close() }}
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <hr/>
    <div class='row'>
        <div class='col-md-4 col-md-offset-1'>
            <table class="table table-striped">
                <thead>
                <tr>
                    <td>Interests</td>
                    <td>
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <a href="{{ route('members.interests.create', $member->id) }}" class="btn btn-block btn-primary" style="margin-top: 18px">New Interest</a>
                            </div>
                        </div>
                    </td>
                </tr>
                </thead>
                <tbody>
                @foreach ($member->interests as $interest)
                    <tr>
                        <td>{{ $interest->interest }}</td>
                        <td>
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    {{ Form::open(['method' => 'DELETE', 'route' => ['members.interests.destroy', $member, $interest], ]) }}
                                    {{ Form::button('<i class="glyphicon glyphicon-trash"></i> Delete', array('type' => 'submit', 'data-id' => $interest->id, 'data-confirm' => 'Are you sure?', 'class' => 'btn btn-danger delete-button', 'onclick' => "return confirm('Are you sure?')")) }}
                                    {{ Form::close() }}
                                </div>
                            </div>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class='col-md-4 col-md-offset-1'>
            <table class="table table-striped">
                <thead>
                <tr>
                    <td>Skill</td>
                    <td>Skill Level</td>
                    <td>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ route('members.skills.create', $member->id) }}" class="btn btn-block btn-primary" style="margin-top: 18px">New Skill</a>
                            </div>
                        </div>
                </tr>
                </thead>
                <tbody>
                @foreach ($member->skills as $skill)
                    <tr>
                        <td>{{ $skill->skill }}</td>
                        <td>{{ $skill->skill_level }}</td>
                        <td>
                            <div class="row">
                                <div class="col-md-12 ">
                                    {{ Form::open(['method' => 'DELETE', 'route' => ['members.skills.destroy', $member, $skill], ]) }}
                                    {{ Form::button('<i class="glyphicon glyphicon-trash"></i> Delete', array('type' => 'submit', 'data-id' => $skill->id, 'data-confirm' => 'Are you sure?', 'class' => 'btn btn-danger delete-button', 'onclick' => "return confirm('Are you sure?')")) }}
                                    {{ Form::close() }}
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            </ul>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-md-3">
            <h3>Schedules</h3>
        </div>
        <div class="col-md-3 col-md-offset-3">
            <a href="{{ route('members.schedules.create', $member->id) }}" class="btn btn-block btn-primary" style="margin-top: 18px">New Schedule</a>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <td>Start Time</td>
                    <td>End Time</td>
                    <td>Day</td>
                    <td>Notes</td>
                    <td id="borderless"></td>
                </tr>
                </thead>
                <tbody>
                @foreach ($member->schedules as $schedule)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($schedule->start_time)->format('g:i A') }}</td>
                        <td>{{ \Carbon\Carbon::parse($schedule->end_time)->format('g:i A') }}</td>
                        @if($schedule->day_id == 1)
                            <td>Monday</td>
                        @elseif($schedule->day_id == 2)
                            <td>Tuesday</td>
                        @elseif($schedule->day_id == 3)
                            <td>Wednesday</td>
                        @elseif($schedule->day_id == 4)
                            <td>Thursday</td>
                        @elseif($schedule->day_id == 5)
                            <td>Friday</td>
                        @elseif($schedule->day_id == 6)
                            <td>Saturday</td>
                        @else
                            <td>Sunday</td>
                        @endif
                        <td>{{ $schedule->notes }}</td>
                        <td>
                            <div class="row">
                                <div class="col-md-12">
                                    {{ Form::open(['method' => 'GET', 'route' => ['members.schedules.edit', $member, $schedule, ]]) }}
                                    {{ Form::button('<i class="glyphicon glyphicon-pencil"></i> Edit', array('type' => 'submit', 'class' => 'btn btn-warning')) }}
                                    {{ Form::close() }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    {{ Form::open(['method' => 'DELETE', 'route' => ['members.schedules.destroy', $member, $schedule, ]]) }}
                                    {{ Form::button('<i class="glyphicon glyphicon-trash"></i> Delete', array('type' => 'submit', 'data-id' => $schedule, 'class' => 'btn btn-danger delete-member', 'onclick' => "return confirm('Are you sure?')")) }}
                                    {{ Form::close() }}
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop