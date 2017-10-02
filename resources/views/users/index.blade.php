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
        dom: "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [
            'excelHtml5', 'copyHtml5', 'print', 'csvHtml5'
        ],
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: {
            "url": '{{ url('users-data') }}',
            "type": 'POST',
        },
        columns: [
        { data: 'id' },
        { data: 'name' },
        { data: 'email' },
        { data: 'last_login_at' },
        ],
    });
});
    </script>
@endpush
