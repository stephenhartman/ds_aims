@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.bootstrap.min.css">
@endpush

@section('title', 'Users')

@section('content')
    <div class="container">
        <h2>All Users</h2>
        <hr>
        <table class="table table-bordered table-striped table-responsive dataTable" id="users-table">
            <thead class="thead-inverse">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>State</th>
                    <th>Zip Code</th>
                    <th>Loyal Lion?</th>
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
        {
            extend:    'copy',
            text:      'Copy <i class="fa fa-files-o"></i>',
            titleAttr: 'Copy'
        },
        {
            extend:    'excel',
            text:      'Export to Excel <i class="fa fa-table"></i>',
            titleAttr: 'Excel'
        },
        {
            extend:    'csv',
            text:      'Export to CSV <i class="fa fa-table"></i>',
            titleAttr: 'CSV'
        },
        {
            extend:    'print',
            text:      'Print <i class="fa fa-print"></i>',
            titleAttr: 'Print'
        },
        {
            extend:    'pdf',
            text:      'Export to PDF <i class="fa fa-print"></i>',
            titleAttr: 'PDF'
        }
        ],
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        processing: true,
        responsive: true,
        ajax: {
            "url": '{{ url('users-data') }}',
            "type": 'POST',
        },
        columns: [
        { data: 'name', name: 'users.name'},
        { data: 'email', name: 'users.email' },
        { data: 'state', name: 'alumni.state' },
        { data: 'zipcode', name: 'alumni.zipcode' },
        { data: 'loyal_lion', name: 'alumni.loyal_lion' },
        { data: 'last_login_at', name: 'users.last_login_at' },
        ],
    });
});
    </script>
@endpush
