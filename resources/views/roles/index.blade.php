@extends('layouts.app')

@section('title', 'User Roles')

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
@endpush

@section('content')
    <div class="container-fluid">
        <div class="col-md-10 col-md-offset-1">
            <h2>User Roles Database</h2>
            <hr>
            <div class="table-responsive">
                <table class="table table-bordered table-striped dataTable" id="roles-table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Administrator?</th>
                        <th>Action</th>
                        <th></th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
    <script>
        $(function() {
            'use strict';

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('#roles-table').DataTable({
                dom: "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                processing: true,
                ajax: {
                    "url": '{{ url('role-data') }}',
                    "type": 'POST'
                },
                columns: [
                    { data: 'name' },
                    { data: 'email' },
                    { data: 'role', sortable: false },
                    { data: 'action', sortable: false },
                    { data: 'close' },
                ]
            });

            $(document).ready(function() {
                $('#form').submit(function () {
                    var sData = table.$('input').serialize();
                    alert("The following data would have been submitted to the server: \n\n" + sData);
                    return false;
                });
            });
        });
    </script>
@endpush
