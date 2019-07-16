@extends('layout.navbar')
    @section('content')
    <style type="text/css">
        .notice {
            padding: 15px;
            background-color: #fafafa;
            border-left: 6px solid #7f7f84;
            margin-bottom: 40px;
            -webkit-box-shadow: 0 5px 8px -6px rgba(0,0,0,.2);
               -moz-box-shadow: 0 5px 8px -6px rgba(0,0,0,.2);
                    box-shadow: 0 5px 8px -6px rgba(0,0,0,.2);
        }
        .notice-sm {
            padding: 10px;
            font-size: 80%;
        }
        .notice-lg {
            padding: 35px;
            font-size: large;
        }
        .notice-success {
            border-color: #80D651;
        }
        .notice-success>strong {
            color: #80D651;
        }
        .notice-info {
            border-color: #45ABCD;
        }
        .notice-info>strong {
            color: #45ABCD;
        }
        .notice-warning {
            border-color: #FEAF20;
        }
        .notice-warning>strong {
            color: #FEAF20;
        }
        .notice-danger {
            border-color: #d73814;
        }
        .notice-danger>strong {
            color: #d73814;
        }
    </style>
    	<div class="page-titles-img title-space-lg parallax-overlay bg-parallax" data-jarallax='{"speed": 0.4}' style='background-image: url("/images/bg13.jpg");background-position:top center;'>
            <div class="container">
                <div class="row">
                    <div class=" col-md-12">
                        <h1 class="text-uppercase">Notification</h1>

                    </div>
                </div>
            </div>
        </div><!--page title end-->

        <div class="container pt90 pb50">
            @if(count($nots) == 0)
                <h2 style="text-align: center">You have no Notificaton yet</h2>
            @else
                <div class="row">
                    @foreach($nots as $not)
                        <div class="col-md-12">
                            <div class="notice notice-{{$not->type}}">
                                <div class="col-md-8">
                                    <strong>{{$not->message}}</strong>
                                </div>
                                <div class="col-md-4">
                                    {{$not->created_at->diffForHumans()}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{$nots->links()}}
            @endif
        </div>   	
    @endsection