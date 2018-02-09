@extends('layouts.app')

@section('title', 'DePaul Community Information')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>DePaul Community Information</h4>
                    </div>
                    <div class="panel-body">
                        @if ($alumnus->initial_setup == 0)
                            {{ Form::open(['route' => array('final_store', $user, $alumnus)]) }}
                            <div class="row">
                                <div class="col-md-5"></div>
                                <div class="col-md-2 text-center">
                                    <img class="img-responsive" src="{{ url('images/logo.png')}}">
                                </div>
                                <div class="col-md-5"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>
                                        Thank you for signing up with the DePaul Alumni Outreach System.  Here are a few additional bits of information.
                                    </h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('loyal_lion', 'Would you like to sign up for the Loyal Lion Program?') }}
                                        {{ Form::checkbox('loyal_lion', 1, null, ['class' => 'form-control'] ) }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('volunteer', 'Would you like to volunteer for the DePaul School?') }}
                                        {{ Form::checkbox('volunteer', 1, null, ['class' => 'form-control'] ) }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <figure class="figure text-center">
                                        <a href="https://clear-give.com/egive3/donate/index.cfm?LocID=536001" target="_blank">
                                            <img class="img-responsive" src="{{ url('images/cleargive.png') }}">
                                        </a>
                                        <figcaption class="figure-caption">
                                            <h4>Gift a whole or partial Tuition</h4>
                                            <p>Gifts are tax-deductible</p>
                                        </figcaption>
                                        <a class="btn btn-lg btn-primary" href="https://clear-give.com/egive3/donate/index.cfm?LocID=536001" target="_blank">
                                            Give now
                                        </a>
                                    </figure>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <figure class="figure text-center">
                                        <a href="http://www.smile.amazon.com/" target="_blank">
                                            <img class="img-responsive" src="{{ url('images/amazon_smile.png') }}">
                                        </a>
                                        <figcaption class="figure-caption">
                                            <h4> Use Smile.Amazon.Com to shop</h4>
                                            <p>Choose DePaul School of North East Florida Inc as your charity at checkout</p>
                                        </figcaption>
                                        <a class="btn btn-lg btn-primary" href="http://www.smile.amazon.com/" target="_blank">
                                            Shop now
                                        </a>
                                    </figure>
                                    </a>
                                </div>
                            </div>
                        <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <figure class="figure text-center">
                                        <a href="https://smile.amazon.com/registry/wishlist/C9G0108K8GEM/ref=cm_sw_r_cp_ep_ws_gpBPzbG3V92Q1"
                                           target="_blank">
                                            <img class="img-responsive" src="{{ url('images/donate_supplies.png') }}">
                                        </a>
                                        <figcaption class="figure-caption">
                                            <h4>Help stock our classrooms</h4>
                                            <p>What exactly do we need?</p>
                                        </figcaption>
                                        <a class="btn btn-lg btn-primary"
                                           href="https://smile.amazon.com/registry/wishlist/C9G0108K8GEM/ref=cm_sw_r_cp_ep_ws_gpBPzbG3V92Q1"
                                           target="_blank">
                                            Shop now
                                        </a>
                                    </figure>
                                    </a>
                                </div>
                                <div class="col-md-6 text-center">
                                    <figure class="figure text-center">
                                        <a href="mailto:?Subject=DePaul%20School%20Referral" target="_top">
                                            <img class="img-responsive" src="{{ url('images/send_email.png') }}">
                                        </a>
                                        <figcaption class="figure-caption">
                                            <h4>Send an email to a friend!</h4>
                                        </figcaption>
                                        <a href="mailto:?Subject=DePaul%20School%20Referral" target="_top" class="btn btn-lg btn-primary">
                                            Refer a friend to DePaul
                                        </a>
                                    </figure>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            {{ Form::submit('Submit', ['class' => 'btn btn-lg btn-success btn-block', 'style' => 'margin-top: 20px;']) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
                @else
                    <div class="row">
                        <div class="col-md-5"></div>
                        <div class="col-md-2 text-center">
                            <img class="img-responsive" src="{{ url('images/logo.png')}}">
                        </div>
                        <div class="col-md-5"></div>
                    </div>
                <br>
                    <div class="row">
                        <div class="col-md-6">
                            <figure class="figure text-center">
                                <a href="https://clear-give.com/egive3/donate/index.cfm?LocID=536001" target="_blank">
                                    <img class="img-responsive" src="{{ url('images/cleargive.png') }}">
                                </a>
                                <figcaption class="figure-caption">
                                    <h4>Gift a whole or partial Tuition</h4>
                                    <p>Gifts are tax-deductible</p>
                                </figcaption>
                                <a class="btn btn-lg btn-primary" href="https://clear-give.com/egive3/donate/index.cfm?LocID=536001" target="_blank">
                                    Give now
                                </a>
                            </figure>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <figure class="figure text-center">
                                <a href="http://www.smile.amazon.com/" target="_blank">
                                    <img class="img-responsive" src="{{ url('images/amazon_smile.png') }}">
                                </a>
                                <figcaption class="figure-caption">
                                    <h4> Use Smile.Amazon.Com to shop</h4>
                                    <p>Choose DePaul School of North East Florida Inc as your charity at checkout</p>
                                </figcaption>
                                <a class="btn btn-lg btn-primary" href="http://www.smile.amazon.com/" target="_blank">
                                    Shop now
                                </a>
                            </figure>
                            </a>
                        </div>
                    </div>
                <br>
                    <div class="row">
                        <div class="col-md-6">
                            <figure class="figure text-center">
                                <a href="https://smile.amazon.com/registry/wishlist/C9G0108K8GEM/ref=cm_sw_r_cp_ep_ws_gpBPzbG3V92Q1"
                                   target="_blank">
                                    <img class="img-responsive" src="{{ url('images/donate_supplies.png') }}">
                                </a>
                                <figcaption class="figure-caption">
                                    <h4>Help stock our classrooms</h4>
                                    <p>What exactly do we need?</p>
                                </figcaption>
                                <a class="btn btn-lg btn-primary"
                                   href="https://smile.amazon.com/registry/wishlist/C9G0108K8GEM/ref=cm_sw_r_cp_ep_ws_gpBPzbG3V92Q1"
                                   target="_blank">
                                    Shop now
                                </a>
                            </figure>
                            </a>
                        </div>
                        <div class="col-md-6 text-center">
                            <figure class="figure text-center">
                                <a href="mailto:?Subject=DePaul%20School%20Referral" target="_top">
                                    <img class="img-responsive" src="{{ url('images/send_email.png') }}">
                                </a>
                                <figcaption class="figure-caption">
                                    <h4>Send an email to a friend!</h4>
                                </figcaption>
                                <a href="mailto:?Subject=DePaul%20School%20Referral" target="_top" class="btn btn-lg btn-primary">
                                    Refer a friend to DePaul
                                </a>
                            </figure>
                        </div>
                    </div>
                @endif
            </div>
        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
