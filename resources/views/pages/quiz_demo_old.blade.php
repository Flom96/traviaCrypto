@extends('layout.navbar')
    @section('content')
    
    
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
            
            <br>
            <div class="row">
                <div class="col-md-12" style="margin-bottom: 30px">
                    <div class="card" style="width: 100%; text-align: center">
                      <div class="card-body">
                        
                            @if($user2 == NULL)
                                <h5 class="card-title">
                                    Wait till you are match with a partner to take the quiz
                                </h5>
                                <p class="card-text">Category: {{$amMatch->Category->name}}</p>
                                <a href="#" class="btn btn-primary">Awaiting Matching</a>
                            @else
                                <h5 class="card-title">
                                    @if($amMatch->user1_id == Auth::User()->id)
                                        {{Auth::User()->username}}, you are match with {{$user2->username}}
                                    @else
                                        {{Auth::User()->username}}, you are match with {{$user1->username}}
                                    @endif
                                </h5>
                                <p class="card-text">Category: {{$amMatch->Category->name}}</p>
                                <form method="post" action="/question">
                                    {{csrf_field()}}
                                    <input type="hidden" name="match_id" value="{{$amMatch->id}}">
                                    <button type="submit" class="btn btn-primary">Start now</button>
                                </form>
                            @endif
                      </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection
        
        