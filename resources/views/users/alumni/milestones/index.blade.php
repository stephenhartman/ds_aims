@extends('layouts.app')

@section('title', 'Alumni Milestones')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Milestones</h4>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <h4>Select a milestone to add...</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 col-md-offset-1">
                                <a class="btn btn-sm btn-block btn-primary" href="{{ route('users.alumni.occupation.create', [$user, $alumnus]) }}">Occupation</a>
                            </div>
                            <div class="col-md-5">
                                <a class="btn btn-sm btn-block btn-primary" href="{{ route('users.alumni.education.create', [$user, $alumnus]) }}">Education</a>
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
                                                <li>Occupaton: {{ $occupation->organization}} {{ $occupation->start_year }}-{{$occupation->end_year}}</li>
                                            @endforeach
                                            @foreach($educations as $education)
                                                <li>Education: {{ $education->school}} {{ $education->start_year }}-{{$education->end_year}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
