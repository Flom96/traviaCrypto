@extends('layout.navbar')
    @section('content')
    
    
        <div class="page-titles-img title-space-lg parallax-overlay bg-parallax" data-jarallax='{"speed": 0.4}' style='background-image: url("/images/bg13.jpg");background-position:top center;'>
            <div class="container">
                <div class="row">
                    <div class=" col-md-12">
                        <h1 class="text-uppercase">Pending Quiz</h1>

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
                                
                                    <p class="card-text">
                                        Status: Not Taken
                                    </p>
                                    <form method="post" action="/question">
                                        {{csrf_field()}}
                                        <input type="hidden" name="match_id" value="{{$match->id}}">
                                        <button type="submit" class="btn btn-primary">Start now</button>
                                    </form>
                                
                                
                                
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
                                    <p class="card-text">
                                        Status: Not Taken
                                    </p>
                                    <form method="post" action="/question">
                                        {{csrf_field()}}
                                        <input type="hidden" name="match_id" value="{{$match->id}}">
                                        <button type="submit" class="btn btn-primary">Start now</button>
                                    </form>
                                
                                
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
                                    <p class="card-text">
                                        Status: Not Taken
                                    </p>
                                    <form method="post" action="/question">
                                        {{csrf_field()}}
                                        <input type="hidden" name="match_id" value="{{$match->id}}">
                                        <button type="submit" class="btn btn-primary">Start now</button>
                                    </form>
                                
                              </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif

            @else
                <h2 style="text-align: center">You have no pending quiz to take</h2>
            @endif
        </div>
        @endsection
        
        