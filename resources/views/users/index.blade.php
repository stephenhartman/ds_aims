@extends('home')

@section('title', '| Users')

@section('content')
    <div class="container">
        <table class="table table-bordered dataTable" id="users-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection

@push('scripts')
    <script>
$(function() {
    $('#users-table').dataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ url('users-data') }}',
        columns: [
        { data: 'id', name: 'id' },
        { data: 'name', name: 'name' },
        { data: 'email', name: 'email' },
        { data: 'created_at', name: 'created_at' },
        { data: 'updated_at', name: 'updated_at' }
        ]
    });
});
    </script>
@endpush
