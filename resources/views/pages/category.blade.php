@extends('layout.navbar')
    @section('content')
    
    
        <div class="page-titles-img title-space-lg parallax-overlay bg-parallax" data-jarallax='{"speed": 0.4}' style='background-image: url("images/bg13.jpg");background-position:top center;'>
            <div class="container">
                <div class="row">
                    <div class=" col-md-12">
                        <h1 class="text-uppercase">Quiz Categories </h1>

                    </div>
                </div>
            </div>
        </div><!--page title end-->
        
        <div class="container pt90 pb50">
            
            <br>
            <div class="row">
                @foreach($cats as $cat)
                    <div class="col-md-4" style="margin-bottom: 30px">
                        <div class="card" style="width: 18rem;">
                          <div class="card-body">
                            <h5 class="card-title">{{$cat->name}}</h5>
                            <p class="card-text">{{$cat->desc}}</p>
                            <form method="post" action="/quiz_demo" id="charge{{$cat->id}}">
                                {{csrf_field()}}
                                
                                <input type="hidden" name="category_id" value="{{$cat->id}}">
                                
                            </form>
                            <button onclick="charge('{{$cat->id}}', '{{$cat->price}}')" class="btn btn-primary">Start now</button>
                          </div>
                        </div>
                    </div>
                @endforeach                
            </div>
        </div>
        
    @endsection
        
        