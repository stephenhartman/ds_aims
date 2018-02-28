<div class="panel panel-default">
    <div class="panel-heading">
        <h4>Milestones</h4>
    </div>
    <div class="panel-body">
        <div class="row">
            @if ($alumnus->initial_setup == 0)
            <div class="col-md-5 col-md-offset-1">
                <h4>Select a milestone to add...</h4>
            </div>
            <div class="col-md-5">
                <a href="{{ route('community', array($user, $alumnus)) }}" class="btn btn-warning btn-sm btn-block">Skip this Step</a>
            </div>
            @else
            <div class="col-md-10 col-md-offset-1">
                <h4>Select a milestone to add...</h4>
            </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-5 col-md-offset-1">
                <a class="btn btn-sm btn-block btn-primary" href="{{ route('users.alumni.occupation.create', [$user, $alumnus]) }}"><i class="fa fa-plus-square"></i> Occupation</a>
            </div>
            <div class="col-md-5">
                <a class="btn btn-sm btn-block btn-primary" href="{{ route('users.alumni.education.create', [$user, $alumnus]) }}"><i class="fa fa-plus-square"></i> Education</a>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Milestones added</h4>
                    </div>
                    <div class="panel-body">
                        <ul>
                            @foreach($occupations as $occupation)
                                <li>
                                    <a href=" {{ route('users.alumni.occupation.edit', [$user, $alumnus, $occupation->id]) }}">
                                        Occupation: {{ $occupation->organization}} {{ $occupation->start_year }}-{{$occupation->end_year}}
                                    </a>
                                </li>
                            @endforeach
                            @foreach($educations as $education)
                                <li>
                                    <a href="{{ route('users.alumni.education.edit', [$user, $alumnus, $education->id]) }}">
                                        Education: {{ $education->school}} {{ $education->start_year }}-{{$education->end_year}}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @if ($alumnus->initial_setup == 0)
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <a href="{{ route('community', array($user, $alumnus)) }}" class="btn btn-success btn-lg btn-block">Continue</a>
            </div>
        </div>
        @endif
    </div>
</div>
