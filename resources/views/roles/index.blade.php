@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/yadcf/0.9.2/jquery.dataTables.yadcf.min.css">
@endpush

@section('title', 'User Roles')

@section('content')
    <div class="container-fluid">
        <div class="col-md-10 col-md-offset-1">
            <h2>User Roles Database</h2>
            <hr>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Administrator?</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    @foreach ($users as $user)
                        <tr>
                            {{ Form::open( ['route' => ['users.update', $user], 'method' => 'PUT']) }}
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            @if ($user->hasRole('admin'))
                                <td><input type="checkbox" name="role" checked></td>
                            @elseif ($user->hasRole('alumni'))
                                <td><input type="checkbox" name="role" unchecked></td>
                            @endif
                            <td>
                                {{ Form::submit('Save', ['class' => 'btn btn-success btn-sm btn-block']) }}
                                {{ Form::close() }}
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection

