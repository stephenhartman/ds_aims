@extends('layouts.app')

@section('title', 'DePaul Alumni Outreach')

@push('styles')
	<link href="https://fonts.googleapis.com/css?family=Cabin+Sketch" rel="stylesheet">
	<style>
		.carousel .left > span,
		.carousel .right > span {
			position: absolute;
			left: 20px;
			top: 50%;
			transform: translateY(-50%);
		}
		.carousel .right > span {
			left: auto;
			right: 20px;
		}
		.carousel-caption {
			background: rgba(0, 0, 0, 0.50);
			max-width: 100%;
			width:100%;
			left: 0;
		}
	</style>
@endpush

@section('content')
	<a href="{{ url('/home') }}" style="font-size:2em!important;text-decoration:none">
		<div class="text-center h1">
			DePaul School Alumni Outreach System
		</div>
	</a>
	<div class="container">
		<div id="carousel-welcome" class="carousel slide" data-ride="carousel">
			<!-- Indicators -->
			<ol class="carousel-indicators">
				@foreach( $photos as $photo )
					<li data-target="#carousel-welcome" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
				@endforeach
			</ol>
			<!-- Wrapper for slides -->
			<div class="carousel-inner" role="listbox">
				@foreach( $photos as $photo )
					<div class="item {{ $loop->first ? ' active' : '' }}" >
						<img src="{{ $photo->photo_url }}" alt="Photo {{ $photo->id }}">
						<div class="carousel-caption" style="padding-top: 40px;">
							<p>{{ $photo->caption }}</p>
						</div>
					</div>
				@endforeach
			</div>
			<!-- Controls -->
			<a class="left carousel-control" href="#carousel-welcome" role="button" data-slide="prev">
				<span class="fa fa-chevron-left" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control" href="#carousel-welcome" role="button" data-slide="next">
				<span class="fa fa-chevron-right" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	</div>
	<a href="{{ url('/home') }}" style="font-size:2em!important;text-decoration:none">
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6 text-center">
            	<span class="h1" style="color: rgb(5, 61, 99);font-family: 'Cabin Sketch', cursive;">
                	DePaul School of Northeast Florida
            	</span>
				<br>
				<span class="h2" style="color: rgb(255, 102, 0);font-family: 'Cabin Sketch', cursive;">
                	We Teach The Way They Learn©
            	</span>
			</div>
			<div class="col-md-3"></div>
		</div>
	</a>
@endsection
