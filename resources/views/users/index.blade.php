@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.bootstrap.min.css">
@endpush

@section('title', 'Users')

@section('content')
    <div class="container table-responsive">
        <h2>All Users</h2>
        <hr>
        <table class="table table-bordered table-striped dataTable" id="users-table">
            <thead class="thead-inverse">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>State</th>
                    <th>Zip Code</th>
                    <th>Volunteer?</th>
                    <th>Loyal Lion?</th>
                    <th>Last Login</th>
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
        ],
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        processing: true,
        ajax: {
            "url": '{{ url('users-data') }}',
            "type": 'POST',
        },
        columns: [
            { data: 'name' },
            { data: 'email' },
            { data: 'state' },
            { data: 'zipcode' },
            { data: 'volunteer' },
            { data: 'loyal_lion' },
            { data: 'last_login_at', orderData: 7 },
            { data: 'date_sort', type: 'num', visible: false }
        ],
    });
});
    </script>
@endpush
