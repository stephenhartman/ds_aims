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

		
			<?php
			//index.php
			$connect = mysqli_connect("localhost", "root", "", "dsaims_dev");
			function make_query($connect) {
				$query = "SELECT * FROM banner ORDER BY banner_id ASC";
				$result = mysqli_query($connect, $query);
				return $result;
			}
			function make_slide_indicators($connect) {
				$output = '';
				$count = 0;
				$result = make_query($connect);
				while ($row = mysqli_fetch_array($result)) {
					if ($count == 0) {
						$output.= '
			   <li data-target="#dynamic_slide_show" data-slide-to="' . $count . '" class="active"></li>
			   ';
					} else {
						$output.= '
			   <li data-target="#dynamic_slide_show" data-slide-to="' . $count . '"></li>
			   ';
					}
					$count = $count + 1;
				}
				return $output;
			}
			function make_slides($connect) {
				$output = '';
				$count = 0;
				$result = make_query($connect);
				while ($row = mysqli_fetch_array($result)) {
					if ($count == 0) {
						$output.= '<div class="item active">';
					} else {
						$output.= '<div class="item">';
					}
					$output.= '
			   <img src="images/carousel/' . $row["banner_image"] . '" alt="' . $row["banner_title"] . '" />
			   <div class="carousel-caption">
				<h3>' . $row["banner_title"] . '</h3>
			   </div>
			  </div>
			  ';
					$count = $count + 1;
				}
				return $output;
			}
			?>

			<!DOCTYPE html>
			<html>
			   <head>
				  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
				  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
				  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
			   </head>
			   <body>
				  <br />
				  <div class="container">
					 <br />
					 <div id="dynamic_slide_show" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
						   <?php echo make_slide_indicators($connect); ?>
						</ol>
						<div class="carousel-inner">
						   <?php echo make_slides($connect); ?>
						</div>
						<a class="left carousel-control" href="#dynamic_slide_show" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left"></span>
						<span class="sr-only">Previous</span>
						</a>
						<a class="right carousel-control" href="#dynamic_slide_show" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right"></span>
						<span class="sr-only">Next</span>
						</a>
					 </div>
				  </div>
			   </body>
			</html>

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
