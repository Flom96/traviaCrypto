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
                            <h5 class="card-title">
                                Category: {{$amMatch->Category->name}}
                            </h5>
                            <p class="card-text">Status: Not Taken</p>
                            <form method="post" action="/question">
                                {{csrf_field()}}
                                <input type="hidden" name="match_id" value="{{$amMatch->id}}">
                                <button type="submit" class="btn btn-primary">Start now</button>
                            </form>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection
        
        