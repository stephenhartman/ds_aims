@extends('layouts.app')

@section('content')
    <div class="container">
        {{ Form::model($alumnus, ['route' => array('users.alumni.update', $user, $alumnus),
        'method' => 'PATCH', 'enctype' => 'multipart/form-data']) }}
        <div class="row">
            <div class="col-md-6">
                @include('layouts.alumnus')
            </div>
            <div class="row">
               <div class="col-md-6">
                  @include('layouts.photo')
               </div>
                <div class="col-md-6">
                    @include('layouts.milestones')
                </div>
            </div>
        </div>
    </div>
@stop