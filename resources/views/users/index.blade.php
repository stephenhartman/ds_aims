@extends('home')

@section('title', '| Users')

@section('content')
    <table class="table table-bordered" id="users-table">
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
@endsection

@push('scripts')
    <script>
$(function() {
    $('#users-table').Datatable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('users.data') }}',
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
