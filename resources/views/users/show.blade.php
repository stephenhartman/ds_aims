@extends('layouts.app')

@section('content')
    <div class="container">
       <div class="row">
            <div class="col-md-6">
                {{ Form::model($user, ['route' => array('users.update', $user),
                'method' => 'PATCH']) }}
                @include('layouts.email')
                {{ Form::close() }}
                {{ Form::model($alumnus, ['route' => array('users.alumni.update', $user, $alumnus),
                'method' => 'PATCH', 'enctype' => 'multipart/form-data']) }}
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