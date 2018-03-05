@extends('layouts.app')

@section('title', 'DePaul Alumni Outreach')

@push('styles')
    <link href="https://fonts.googleapis.com/css?family=Cabin+Sketch" rel="stylesheet">
@endpush

@section('content')
    <a href="{{ url('/home') }}" style="font-size:2em!important;text-decoration:none">
        <div class="text-center h1" style="">
            DePaul School Alumni Outreach System
        </div>
        <div class="row">
		
			@push('styles')
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
					}
				</style>
			@endpush

			@section('content')
				<div class="container">
					<div class="panel panel-default">
						<div class="panel-heading">
							<div class="row">
								<div class="col-md-4">
									<h2>Carousel</h2>
								</div>
								<div class="col-md-6"></div>
								<div class="col-md-2 col-sm-12">
									
										
								</div>
							</div>
						</div>
						<div class="panel-body">
							<div id="carousel-photos" class="carousel slide" data-ride="carousel">

								<!-- Indicators -->
								<ol class="carousel-indicators">
									@foreach( $photos as $photo )
										<li data-target="#carousel-photos" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
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
								<a class="left carousel-control" href="#carousel-photos" role="button" data-slide="prev">
									<span class="fa fa-chevron-left" aria-hidden="true"></span>
									<span class="sr-only">Previous</span>
								</a>
								<a class="right carousel-control" href="#carousel-photos" role="button" data-slide="next">
									<span class="fa fa-chevron-right" aria-hidden="true"></span>
									<span class="sr-only">Next</span>
								</a>
							</div>
							<div class="text-center">
								
							</div>
						</div>
						</div>
					</div>
				</div>
			

            <div class="col-md-4"></div>
            <div class="col-md-4">
                <img src="{{url('/images/logo.png')}}" style="height:auto;width:50%;display:block;margin: 0 auto;" alt="Logo">
            </div>
            <div class="col-md-4"></div>
        </div>
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
        </div>
    </a>
@endsection
