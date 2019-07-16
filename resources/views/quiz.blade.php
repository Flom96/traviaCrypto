@extends('layout.navbar')
    @section('content')
    
    
        <div class="page-titles-img title-space-lg parallax-overlay bg-parallax" data-jarallax='{"speed": 0.4}' style='background-image: url("images/bg13.jpg");background-position:top center;'>
            <div class="container">
                <div class="row">
                    <div class=" col-md-12">
                        <h1 class="text-uppercase">Quiz </h1>

                    </div>
                </div>
            </div>
        </div><!--page title end-->
        
        <div class="container pt90 pb50">
            <p class="lead text-center">
                countdown: <span id="countdown">11</span> secs
            </p>
            <script>
                var timeLeft = 11;
                var dTimer = setInterval(function() {
                    if(sessionStorage.sTime) {
                        timeLeft = Number(sessionStorage.sTime);
                    }
                    timeLeft--;
                    sessionStorage.sTime = timeLeft;
                    document.getElementById("countdown").textContent = timeLeft;
                    if(timeLeft <= 0) {
                        clearInterval(dTimer);
                        sessionStorage.removeItem('sTime');
                    }
                    
                }, 1000)
            </script>
            <br>
            <div class="row">
                <div class="pricing-table  align-items-center">
                    
                    <div class="col-lg-12 col-md-12 plan popular-plan">
                        <div class="plan-header">
                            <h4>1<small>/10</small></h4>
                            <h1 class="text-primary" style="text-align:center">
                                What is the northermost capital of an independent nation in the world?
                            </h1>
                            <h6>0<small> pts</small></h6>
                        </div>
                        <div class="row pb60">
                            <div class="col-lg-6 mb30">
                                <a href="#" class="btn btn-primary btn-lg btn-block">Option 1</a>
                            </div>
                            
                            <div class="col-lg-6 mb30">
                                <a href="#" class="btn btn-primary btn-lg btn-block">Option 2</a>
                            </div>
                            <div class="col-lg-6 mb30">
                                <a href="#" class="btn btn-primary btn-lg btn-block">Option 3</a>
                            </div>
                            
                            <div class="col-lg-6 mb30">
                                <a href="#" class="btn btn-primary btn-lg btn-block">Option 4</a>
                            </div>
                        </div>
                        
                        
                        
                    </div>
                    
                </div>
            </div>
        </div>
        @endsection
        
        