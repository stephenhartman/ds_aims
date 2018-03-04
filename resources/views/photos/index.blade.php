@extends('layouts.app')

@section('title', 'Browse Photos')

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
                        <h2>Browse Photos</h2>
                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-2 col-sm-12">
                        @if (Auth::user()->hasRole('admin'))
                            <a href="{{ route('photos.create') }}" class="btn btn-block btn-primary btn-lg"><i class="fa fa-plus-square"></i> New Photo</a>
                        @endif
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
                                    @if (Auth::user()->hasRole('admin'))
                                        <a href="{{ route('photos.edit', $photo) }}" class="btn btn-default btn-sm">Edit Photo</a>
                                    @endif
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
                    {{ $photos->links() }}
                </div>
            </div>
            </div>
        </div>
    </div>
@stop
