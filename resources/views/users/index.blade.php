@extends('home')

@section('title', '| Users')

@section('content')
    <div class="container">
        <h2>All Users</h2>
        <hr>
        <table class="table table-bordered table-striped table-responsive dataTable" id="users-table">
            <thead class="thead-inverse">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Last Login At</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection

@push('scripts')
    <script>
$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var table = $('#users-table').dataTable({
        "dom": 'lBftip',
        'buttons': [
            'csvHtml5',
            'excelHtml5',
            {
                extend: 'pdfHtml5',
                orientation: 'landscape'
            }
        ],
        processing: true,
        serverSide: true,
        ajax: {
            "url": '{{ url('users-data') }}',
            "type": 'POST',
        },
        columns: [
        { data: 'id', name: 'id' },
        { data: 'name', name: 'name' },
        { data: 'email', name: 'email' },
        { data: 'last_login_at', name: 'last_login_at' },
        ],
    });
});
    </script>
@endpush
