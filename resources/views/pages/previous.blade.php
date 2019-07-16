@extends('layout.navbar')
    @section('content')
    
    
        <div class="page-titles-img title-space-lg parallax-overlay bg-parallax" data-jarallax='{"speed": 0.4}' style='background-image: url("/images/bg13.jpg");background-position:top center;'>
            <div class="container">
                <div class="row">
                    <div class=" col-md-12">
                        <h1 class="text-uppercase">Quiz History</h1>

                    </div>
                </div>
            </div>
        </div><!--page title end-->
        
        <div class="container pt90 pb50">
            @if(count($matches) > 0)
                @if(count($matches) > 2)
                    <div class="row">
                        @foreach($matches as $match)
                        <div class="col-md-4" style="margin-bottom: 30px">
                            <div class="card" style="width: 18rem;">
                              <div class="card-body">
                                <h5 class="card-title">
                                   {{$match->category->name}}
                                </h5>
                                @if($match->taken == true)
                                    <p class="card-text">
                                        <?php
                                            $status = '';
                                            $color = 'primary';
                                            $msg = '';
                                            if($match->user1_id == Auth::User()->id) {
                                                $y_score = $match->user1_score;
                                                $o_score = $match->user2_score;
                                                if($match->user1_score > $match->user2_score) {
                                                    $status = 'Win';
                                                    $msg = 'Win, you can do better';
                                                    $color = 'success';
                                                }
                                                elseif($match->user1_score == $match->user2_score) {
                                                    $status = 'Tie';
                                                    $msg = 'Tie, try again later';
                                                    $color = 'info';
                                                }
                                                else {
                                                    $status = 'Loss';
                                                    $msg = 'Loss, get better next time';
                                                    $color = 'danger';
                                                }
                                            }
                                            else {
                                                $y_score = $match->user2_score;
                                                $o_score = $match->user1_score;
                                                if($match->user2_score > $match->user1_score) {
                                                    $status = 'Win';
                                                    $msg = 'Win, you can do better';
                                                    $color = 'success';
                                                }
                                                elseif($match->user1_score == $match->user2_score) {
                                                    $status = 'Tie';
                                                    $msg = 'Tie, try again later';
                                                    $color = 'info';
                                                }
                                                else {
                                                    $status = 'Loss';
                                                    $msg = 'Loss, get better next time';
                                                    $color = 'danger';
                                                }
                                            }
                                        ?>
                                        My Score: {{$y_score}}% <br>
                                        Other User Score: {{$o_score}}%
                                    </p>
                                    <button class="btn btn-{{$color}}">{{$msg}}</button>
                                @else
                                    <p class="card-text">
                                        Status: Awaiting other user quiz result
                                    </p>
                                    <button type="submit" class="btn btn-primary">Awaiting</button>
                                @endif
                              </div>
                            </div>
                        </div>
                        @endforeach
                    </div>                  
                @elseif(count($matches) == 2)
                    <div class="row">
                        @foreach($matches as $match)
                        <div class="col-md-6" style="margin-bottom: 30px">
                            <div class="card" style="width: 100%; text-align: center;">
                              <div class="card-body">
                                <h5 class="card-title">
                                   {{$match->category->name}}
                                </h5>
                                @if($match->taken == true)
                                    <p class="card-text">
                                        <?php
                                            $status = '';
                                            $color = 'primary';
                                            $msg = '';
                                            if($match->user1_id == Auth::User()->id) {
                                                $y_score = $match->user1_score;
                                                $o_score = $match->user2_score;
                                                if($match->user1_score > $match->user2_score) {
                                                    $status = 'Win';
                                                    $msg = 'Win, you can do better';
                                                    $color = 'success';
                                                }
                                                elseif($match->user1_score == $match->user2_score) {
                                                    $status = 'Tie';
                                                    $msg = 'Tie, try again later';
                                                    $color = 'info';
                                                }
                                                else {
                                                    $status = 'Loss';
                                                    $msg = 'Loss, get better next time';
                                                    $color = 'danger';
                                                }
                                            }
                                            else {
                                                $y_score = $match->user2_score;
                                                $o_score = $match->user1_score;
                                                if($match->user2_score > $match->user1_score) {
                                                    $status = 'Win';
                                                    $msg = 'Win, you can do better';
                                                    $color = 'success';
                                                }
                                                elseif($match->user1_score == $match->user2_score) {
                                                    $status = 'Tie';
                                                    $msg = 'Tie, try again later';
                                                    $color = 'info';
                                                }
                                                else {
                                                    $status = 'Loss';
                                                    $msg = 'Loss, get better next time';
                                                    $color = 'danger';
                                                }
                                            }
                                        ?>
                                        My Score: {{$y_score}}% <br>
                                        Other User Score: {{$o_score}}%
                                    </p>
                                    <button class="btn btn-{{$color}}">{{$msg}}</button>
                                @else
                                    <p class="card-text">
                                        Status: Awaiting other user quiz result
                                    </p>
                                    <button type="submit" class="btn btn-primary">Awaiting</button>
                                @endif
                              </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else 
                    <div class="row">
                        @foreach($matches as $match)
                        <div class="col-md-12" style="margin-bottom: 30px">
                            <div class="card" style="width: 100%; text-align: center">
                              <div class="card-body">
                                <h5 class="card-title">
                                   {{$match->category->name}}
                                </h5>
                                @if($match->taken == true)
                                    <p class="card-text">
                                        <?php
                                            $status = '';
                                            $color = 'primary';
                                            $msg = '';
                                            if($match->user1_id == Auth::User()->id) {
                                                $y_score = $match->user1_score;
                                                $o_score = $match->user2_score;
                                                if($match->user1_score > $match->user2_score) {
                                                    $status = 'Win';
                                                    $msg = 'Win, you can do better';
                                                    $color = 'success';
                                                }
                                                elseif($match->user1_score == $match->user2_score) {
                                                    $status = 'Tie';
                                                    $msg = 'Tie, try again later';
                                                    $color = 'info';
                                                }
                                                else {
                                                    $status = 'Loss';
                                                    $msg = 'Loss, get better next time';
                                                    $color = 'danger';
                                                }
                                            }
                                            else {
                                                $y_score = $match->user2_score;
                                                $o_score = $match->user1_score;
                                                if($match->user2_score > $match->user1_score) {
                                                    $status = 'Win';
                                                    $msg = 'Win, you can do better';
                                                    $color = 'success';
                                                }
                                                elseif($match->user1_score == $match->user2_score) {
                                                    $status = 'Tie';
                                                    $msg = 'Tie, try again later';
                                                    $color = 'info';
                                                }
                                                else {
                                                    $status = 'Loss';
                                                    $msg = 'Loss, get better next time';
                                                    $color = 'danger';
                                                }
                                            }
                                        ?>
                                        My Score: {{$y_score}}% <br>
                                        Other User Score: {{$o_score}}%
                                    </p>
                                    <button class="btn btn-{{$color}}">{{$msg}}</button>
                                @else
                                    <p class="card-text">
                                        Status: Awaiting other user quiz result
                                    </p>
                                    <button type="submit" class="btn btn-primary">Awaiting</button>
                                @endif
                              </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif

            @else
                <h2 style="text-align: center">You have not taken any Quiz on this platform</h2>
            @endif
        </div>
        @endsection
        