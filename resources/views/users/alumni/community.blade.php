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
                                <div class="col-md-5 col-sm-5 col-xs-3"></div>
                                <div class="col-md-2 col-sm-2 col-xs-6 text-center">
                                    <img class="img-responsive" src="{{ url('images/logo.png')}}">
                                </div>
                                <div class="col-md-5 col-sm-5 col-xs-3"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>
                                        Thank you for signing up with the DePaul Alumni Outreach System.  Here are a few additional bits of information.
                                    </h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-1">
                                        {{ Form::checkbox('loyal_lion', null, null, ['class' => 'form-control'] ) }}
                                    </div>
                                    <div class="col-md-5">
                                        {{ Form::label('loyal_lion', 'Would you like to sign up for the Loyal Lion Program?') }}
                                    </div>
                                    <div class="col-md-1">
                                        {{ Form::checkbox('volunteer', null, null, ['class' => 'form-control'] ) }}
                                    </div>
                                    <div class="col-md-5">
                                        {{ Form::label('volunteer', 'Would you like to volunteer for the DePaul School?') }}
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
                                            <h4>Gift a whole or partial tuition</h4>
                                            <p>Donate through ClearGive</p>
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
                                            <h4>Use Amazon to shop</h4>
                                            <p>Choose DePaul School of North East Florida Inc</p>
                                            <p>as your charity at checkout</p>
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
                                        <a href="mailto:?subject=DePaul%20School%20Referral&body=I%20want%20to%20show%20you%20https%3A%2F%2Fwww.depaulalumni.com&cc=info@depaulschool.com" target="_top">
                                            <img class="img-responsive" src="{{ url('images/send_email.png') }}">
                                        </a>
                                        <figcaption class="figure-caption">
                                            <h4>Send an email to a friend!</h4>
                                            <p>Refer someone to the DePaul School</p>
                                        </figcaption>
                                        <a href="mailto:?subject=DePaul%20School%20Referral&body=I%20want%20to%20show%20you%20https%3A%2F%2Fwww.depaulalumni.com&cc=info@depaulschool.com" target="_top" class="btn btn-lg btn-primary">
                                            Refer a friend to DePaul
                                        </a>
                                    </figure>
                                </div>
                            </div>
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                {{ Form::button('<i class="fa fa-save"></i> Submit', ['type' => 'submit', 'class' => 'btn btn-success btn-lg btn-block']) }}
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
                @else
                    <div class="row">
                        <div class="col-md-5 col-sm-5 col-xs-3"></div>
                        <div class="col-md-2 col-sm-2 col-xs-6 text-center">
                            <img class="img-responsive" src="{{ url('images/logo.png')}}">
                        </div>
                        <div class="col-md-5 col-sm-5 col-xs-3"></div>
                    </div>
                <br>
                    <div class="row">
                        <div class="col-md-6">
                            <figure class="figure text-center">
                                <a href="https://clear-give.com/egive3/donate/index.cfm?LocID=536001" target="_blank">
                                    <img class="img-responsive" src="{{ url('images/cleargive.png') }}">
                                </a>
                                <figcaption class="figure-caption">
                                    <h4>Gift a whole or partial tuition</h4>
                                    <p>Donate through ClearGive</p>
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
                                    <h4>Use Amazon Smile to shop</h4>
                                    <p>Choose DePaul School of North East Florida Inc</p>
                                    <p>as your charity at checkout</p>
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
                                <a href="mailto:?subject=DePaul%20School%20Referral&body=I%20want%20to%20show%20you%20https%3A%2F%2Fwww.depaulalumni.com&cc=info@depaulschool.com" target="_top">
                                    <img class="img-responsive" src="{{ url('images/send_email.png') }}">
                                </a>
                                <figcaption class="figure-caption">
                                    <h4>Send an email to a friend!</h4>
                                    <p>Refer someone to the DePaul School</p>
                                </figcaption>
                                <a href="mailto:?subject=DePaul%20School%20Referral&body=I%20want%20to%20show%20you%20https%3A%2F%2Fwww.depaulalumni.com&cc=info@depaulschool.com" target="_top" class="btn btn-lg btn-primary">
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
