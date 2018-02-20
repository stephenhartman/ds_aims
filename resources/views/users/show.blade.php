@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                @include('layouts.alumnus')
            </div>
            <div class="col-md-6">
                @include('layouts.milestones')
            </div>
        </div>
    </div>
@stop