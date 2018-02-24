@extends('layouts.app')

@section('title', 'Browse Posts')

@push('scripts')
	<script>
        $(function() {
            $('body').on('click', '.pagination a', function (e) {
                e.preventDefault();

                var url = $(this).attr('href');
                getPosts(url);
                window.history.pushState("", "", url);
                $("html, body").animate({ scrollTop: 63 }, 250);
            });

            function getPosts(url) {
                $.ajax({
                    type: "GET",
                    url: url
                }).done(function (data) {
                    $('.posts').html(data);
                }).fail(function () {
                    alert('Posts could not be loaded.');
                });
            }
        });
	</script>
@endpush

@section('content')
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="row">
					<div class="col-md-4">
						<h2>Browse Posts</h2>
					</div>
					<div class="col-md-6"></div>
					<div class="col-md-2 col-sm-12">
						@if (Auth::user()->hasRole('admin'))
							<a href="{{ route('posts.create') }}" class="btn btn-block btn-primary btn-lg" style="margin-top: 18px">New Post</a>
						@endif
					</div>
				</div>
			</div>
			<div class="panel-body">
				@if (count($posts) > 0)
					<section class="posts">
						@include('posts.load')
					</section>
				@endif
			</div>
		</div>
	</div>
@stop
