@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/yadcf/0.9.2/jquery.dataTables.yadcf.min.css">
@endpush

@section('title', 'Alumni Database')

@section('content')
    <div class="container-fluid">
        <h2>Alumni Database</h2>
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered table-striped dataTable" id="users-table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>State</th>
                    <th>Zip Code</th>
                    <th>Graduation Year</th>
                    <th>Volunteer?</th>
                    <th>Loyal Lion?</th>
                    <th>Last Login</th>
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
        $(function() {
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
            var table = $('#users-table').DataTable({
                dom: "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                buttons: [
                    {
                        extend:    'copyHtml5',
                        text:      'Copy <i class="fa fa-files-o"></i>',
                        exportOptions : {
                            columns : ':visible',
                            format : {
                                header : function (mDataProp, columnIdx) {
                                    var htmlText = '<span>' + mDataProp + '</span>';
                                    var jHtmlObject = jQuery(htmlText);
                                    jHtmlObject.find('div').remove();
                                    var newHtml = jHtmlObject.text();
                                    console.log('My header > ' + newHtml);
                                    return newHtml;
                                }
                            }
                        }
                    },
                    {
                        extend:    'excelHtml5',
                        text:      'Export to Excel <i class="fa fa-table"></i>',
                        exportOptions : {
                            columns : ':visible',
                            format : {
                                header : function (mDataProp, columnIdx) {
                                    var htmlText = '<span>' + mDataProp + '</span>';
                                    var jHtmlObject = jQuery(htmlText);
                                    jHtmlObject.find('div').remove();
                                    var newHtml = jHtmlObject.text();
                                    console.log('My header > ' + newHtml);
                                    return newHtml;
                                }
                            }
                        }
                    },
                    {
                        extend:    'csvHtml5',
                        text:      'Export to CSV <i class="fa fa-table"></i>',
                        title:     'Alumni-' + getFormattedDate(),
                        exportOptions : {
                            columns : ':visible',
                            format : {
                                header : function (mDataProp, columnIdx) {
                                    var htmlText = '<span>' + mDataProp + '</span>';
                                    var jHtmlObject = jQuery(htmlText);
                                    jHtmlObject.find('div').remove();
                                    var newHtml = jHtmlObject.text();
                                    console.log('My header > ' + newHtml);
                                    return newHtml;
                                }
                            }
                        }
                    },
                    {
                        extend:    'print',
                        text:      'Print <i class="fa fa-print"></i>',
                        exportOptions : {
                            columns : ':visible',
                            format : {
                                header : function (mDataProp, columnIdx) {
                                    var htmlText = '<span>' + mDataProp + '</span>';
                                    var jHtmlObject = jQuery(htmlText);
                                    jHtmlObject.find('div').remove();
                                    var newHtml = jHtmlObject.text();
                                    console.log('My header > ' + newHtml);
                                    return newHtml;
                                }
                            }
                        }
                    },
                    'colvis'
                ],
                lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                processing: true,
                ajax: {
                    "url": '{{ url('alumni-data') }}',
                    "type": 'POST',
                },
                columns: [
                    { data: 'name' },
                    { data: 'email' },
                    { data: 'state', name: 'alumni.state' },
                    { data: 'zipcode', name: 'alumni.zipcode' },
                    { data: 'year_graduated', name: 'alumni.year_graduated' },
                    { data: 'volunteer', name: 'alumni.state' },
                    { data: 'loyal_lion', name: 'alumni.loyal_lion' },
                    { data: 'last_login_at', orderData: 8 },
                    { data: 'date_sort', type: 'num', visible: false }
                ],
            });

            yadcf.init(table, [{
                column_number: 2,
                filter_default_label: ''
            }, {
                column_number: 3,
                filter_type: 'text'
            }, {
                column_number: 4,
                filter_type: 'range_number_slider',
                filter_default_label: ''
            }, {
                column_number: 5,
                filter_default_label: ''
            }, {
                column_number: 6,
                filter_default_label: ''
            }]);
        });
    </script>
@endpush
