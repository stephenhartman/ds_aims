@extends('layouts.app')

@section('title', 'Create Event')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-1 col-sm-6 col-sm-offset-5">
            <h1>Event Volunteers</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            <table class="table">
                <thead>
                    <th>User_Id</th>
                    <th>Number Attending</th>
                    <th>Notes</th>
                </thead>
                <tbody>
                    @foreach($volunteers as $volunteer)
                        <tr>
                            <td>{{$volunteer->id}}</td>
                            <td>{{$volunteer->number_attending}}</td>
                            <td>{{$volunteer->notes}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection