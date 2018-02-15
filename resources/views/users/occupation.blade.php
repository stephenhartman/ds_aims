@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/yadcf/0.9.2/jquery.dataTables.yadcf.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.bootstrap.min.css">
@endpush

@section('title', 'Users')

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/yadcf/0.9.2/jquery.dataTables.yadcf.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
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

            var table = $('#occupations-table').DataTable({
                dom: "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                buttons: [
                    {
                        extend:    'copy',
                        text:      'Copy <i class="fa fa-files-o"></i>',
                    },
                    {
                        extend:    'excel',
                        text:      'Export to Excel <i class="fa fa-table"></i>',
                    },
                    {
                        extend:    'csv',
                        text:      'Export to CSV <i class="fa fa-table"></i>',
                        title: 'Alumni-Occupation-' + getFormattedDate(),
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
                    },
                ],
                lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                processing: true,
                ajax: {
                    "url": '{{ url('occupation-data') }}',
                    "type": 'POST',
                },
                columns: [
                    { data: 'name' },
                    { data: 'email' },
                    { data: 'organization' },
                    { data: 'position' },
                    { data: 'start_year' },
                    { data: 'end_year' },
                    { data: 'testimonial' },
                    { data: 'share' }
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
                filter_default_label: ''
            }, {
                column_number: 5,
                filter_default_label: ''
            }, {
                column_number: 7,
                filter_default_label: ''
            }]);
        });
    </script>
@endpush