@extends('layouts.app')

@section('title', 'User Roles')

@push('scripts')
    <script>
        $(function() {
            $('body').on('click', '.pagination a', function (e) {
                e.preventDefault();

                var url = $(this).attr('href');
                getUsers(url);
                window.history.pushState("", "", url);
                $("html, body").animate({ scrollTop: 63 }, 250);
            });

            function getUsers(url) {
                $.ajax({
                    url: url
                }).done(function (data) {
                    $('.users').html(data);
                }).fail(function () {
                    alert('Posts could not be loaded.');
                });
            }
        });
    </script>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="col-md-10 col-md-offset-1">
            <h2>User Roles Database</h2>
            <hr>
            <div class="table-responsive">
                    @if (count($users) > 0)
                        <div class="users">
                            @include('roles.load')
                        </div>
                    @endif
            </div>
        </div>
    </div>
@endsection

