@extends('layouts.app')

@section('title', 'DePaul Community Information')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>DePaul Community Information</h4>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-5 col-sm-5 col-xs-3"></div>
                            <div class="col-md-2 col-sm-2 col-xs-6 text-center">
                                <img class="img-responsive" src="{{ url('images/logo.png')}}">
                            </div>
                            <div class="col-md-5 col-sm-5 col-xs-3"></div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <figure class="figure text-center">
                                    <a href="https://clear-give.com/egive3/donate/index.cfm?LocID=536001" target="_blank">
                                        <img class="img-responsive" style="display:inherit; border: 3px solid #e7e7e7; border-radius:5px; padding: 0;" src="{{ url('images/cleargive.png') }}">
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
                                <hr class="hidden-md hidden-lg">
                                <figure class="figure text-center">
                                    <a href="http://www.smile.amazon.com/" target="_blank">
                                        <img class="img-responsive" style="display:inherit; border: 3px solid #e7e7e7; border-radius:5px; padding: 0;" src="{{ url('images/amazon_smile.png') }}">
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
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <figure class="figure text-center">
                                    <a href="https://smile.amazon.com/registry/wishlist/C9G0108K8GEM/ref=cm_sw_r_cp_ep_ws_gpBPzbG3V92Q1"
                                       target="_blank">
                                        <img class="img-responsive" style="display:inherit" src="{{ url('images/donate_supplies.png') }}">
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
                            <div class="col-md-6">
                                <hr class="hidden-md hidden-lg">
                                <figure class="figure text-center">
                                    <a href="mailto:?subject=DePaul%20School%20Referral&body=I%20want%20to%20show%20you%20https%3A%2F%2Fwww.depaulalumni.com&cc=info@depaulschool.com" target="_top">
                                        <img class="img-responsive" style="display:inherit" src="{{ url('images/send_email.png') }}">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
