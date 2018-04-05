@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/yadcf/0.9.2/jquery.dataTables.yadcf.min.css">
@endpush

@section('title', 'Occupation Database')

@section('content')
    <div class="container-fluid">
        <h2>Alumni Occupation Milestone Database</h2>
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered table-striped dataTable" id="occupations-table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Organization</th>
                    <th>Position</th>
                    <th>Year Started</th>
                    <th>Year Ended</th>
                    <th>Testimonial</th>
                    <th>Share?</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/yadcf/0.9.2/jquery.dataTables.yadcf.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js"></script>
    <script>
        $(document).ready(function() {
            var buttonCommon = {
                exportOptions: {
                    columns: ':visible',
                    format: {
                        header: function (mDataProp, columnIdx) {
                            var htmlText = '<span>' + mDataProp + '</span>';
                            var jHtmlObject = jQuery(htmlText);
                            jHtmlObject.find('div').remove();
                            var newHtml = jHtmlObject.text();
                            console.log('My header > ' + newHtml);
                            return newHtml;
                        }
                    }
                }
            };
            $(function () {
                'use strict';

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                function getFormattedDate() {
                    var date = new Date();

                    var year = date.getFullYear();

                    var month = (1 + date.getMonth()).toString();
                    month = month.length > 1 ? month : '0' + month;

                    var day = date.getDate().toString();
                    day = day.length > 1 ? day : '0' + day;

                    return month + '-' + day + '-' + year;
                }

                var table = $('#occupations-table').DataTable({
                    dom: "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                    buttons: [
                        $.extend(true, {}, buttonCommon, {
                            extend: 'copyHtml5',
                            text: '<i class="fa fa-files-o"></i> Copy',
                        }),
                        $.extend(true, {}, buttonCommon, {
                            extend: 'excelHtml5',
                            text: '<i class="fa fa-table"></i> Export Excel',
                            title: 'occupation_data_' + getFormattedDate(),
                        }),
                        $.extend(true, {}, buttonCommon, {
                            extend: 'print',
                            text: '<i class="fa fa-print"></i> Print',
                        }),
                        $.extend(true, {}, buttonCommon, {
                            extend: 'csvHtml5',
                            text: '<i class="fa fa-table"></i> Export CSV',
                            title: 'occupation_data_' + getFormattedDate(),
                        }),
                    ],
                    lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                    processing: true,
                    ajax: {
                        "url": '{{ url('occupation-data') }}',
                        "type": 'POST',
                    },
                    columns: [
                        {data: 'name'},
                        {data: 'email'},
                        {data: 'organization'},
                        {data: 'position'},
                        {data: 'start_year'},
                        {data: 'end_year'},
                        {data: 'testimonial', visible: false},
                        {data: 'share'}
                    ],
                });

                yadcf.init(table, [{
                    column_number: 2,
                    filter_type: 'text'
                }, {
                    column_number: 3,
                    filter_type: 'text'
                }, {
                    column_number: 4,
                    filter_default_label: 'All'
                }, {
                    column_number: 5,
                    filter_default_label: 'All'
                }, {
                    column_number: 7,
                    filter_default_label: 'All'
                }]);
            });
        });
    </script>
@endpush
