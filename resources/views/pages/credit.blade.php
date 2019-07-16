@extends('layout.navbar')
    @section('content')
    	<div class="page-titles-img title-space-lg parallax-overlay bg-parallax" data-jarallax='{"speed": 0.4}' style='background-image: url("/images/bg13.jpg");background-position:top center;'>
            <div class="container">
                <div class="row">
                    <div class=" col-md-12">
                        <h1 class="text-uppercase">Credit BTC Wallet</h1>

                    </div>
                </div>
            </div>
        </div><!--page title end-->

        <div class="container pt90 pb50">
            <div class="row">
                <div class="col-md-12" style="margin-bottom: 30px">
                    <div class="card" style="width: 100%; text-align: center">
                      <div class="card-body">
                        <h5 class="card-title">
                            Click on the button below to generate BTC address to transfer the fund
                        </h5>
                        <p class="card-text" style="font-size: 25px">Address: <strong><span class="address"></span></strong></p>
                        <a href="#" id="gen" class="btn btn-primary" onclick="generate()">generate BTC address</a>
                        <div id="qrcode" style="text-align: center"></div>
                      </div>
                    </div>
                </div>
            </div>
        </div>    	
    @endsection