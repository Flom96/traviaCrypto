@extends('layout.navbar')
    @section('content')
        <script type="text/javascript" src="/js/count.js"></script>
        <script>noanswer('{{$ques->id}}')</script>
        <div class="page-titles-img title-space-lg parallax-overlay bg-parallax" data-jarallax='{"speed": 0.4}' style='background-image: url("/images/bg13.jpg");background-position:top center;'>
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
                countdown: <span id="countdown">6</span> secs
            </p>
            
            <br>
            <div class="row">
                <div class="pricing-table  align-items-center">
                    
                    <div class="col-lg-12 col-md-12 plan popular-plan">
                        <div class="plan-header">
                            @if($match->user1_id == Auth::User()->id)
                                <h4>{{$match->user1_done + 1}}<small>/10</small></h4>
                            @else
                                <h4>{{$match->user2_done + 1}}<small>/10</small></h4>
                            @endif
                            <h1 class="text-primary" style="text-align:center">
                                {{$ques->que}}
                            </h1>
                            @if($match->user1_id == Auth::User()->id)
                                <h6>{{$match->user1_score}}<small> pts</small></h6>
                            @else
                                <h6>{{$match->user2_score}}<small> pts</small></h6>
                            @endif
                        </div>
                        <div class="row pb60">
                            <div class="col-lg-6 mb30">
                                <a href="#" class="btn btn-primary btn-lg btn-block" onclick="checkAnswer('{{$ques->option_1}}', '{{$ques->id}}')">{{$ques->option_1}}</a>
                            </div>
                            
                            <div class="col-lg-6 mb30">
                                <a href="#" class="btn btn-primary btn-lg btn-block" onclick="checkAnswer('{{$ques->option_2}}', '{{$ques->id}}')">{{$ques->option_2}}</a>
                            </div>
                            <div class="col-lg-6 mb30">
                                <a href="#" class="btn btn-primary btn-lg btn-block" onclick="checkAnswer('{{$ques->option_3}}', '{{$ques->id}}')">{{$ques->option_3}}</a>
                            </div>
                            
                            <div class="col-lg-6 mb30">
                                <a href="#" class="btn btn-primary btn-lg btn-block" onclick="checkAnswer('{{$ques->option_4}}', '{{$ques->id}}')">{{$ques->option_4}}</a>
                            </div>
                        </div>
                        
                        
                        
                    </div>
                    
                </div>
            </div>
        </div>

        
        @endsection
        
        