@extends('layout.navbar')
    @section('content')
    <link href="/css/profile.css" rel="stylesheet">
    	<div class="page-titles-img title-space-lg parallax-overlay bg-parallax" data-jarallax='{"speed": 0.4}' style='background-image: url("/images/bg13.jpg");background-position:top center;'>
            <div class="container">
                <div class="row">
                    <div class=" col-md-12">
                        <h1 class="text-uppercase">Profile</h1>

                    </div>
                </div>
            </div>
        </div><!--page title end-->

    	<div class="container emp-profile">
            <form method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img class="img-class" src="/userImages/{{Auth::User()->img}}" alt=""/>
                            <div class="file btn btn-lg btn-primary">
                                Change Photo
                                <input type="file" name="file" id="file" onchange="updateImg()">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                                    <h5>
                                        {{Auth::User()->name}}
                                    </h5>
                                    <h6>
                                        member @ triviacrypto.tech
                                    </h6>
                                    <p class="proile-rating">WALLET : <span>{{Auth::User()->wal_let}} btc</span></p>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <input type="button" class="profile-edit-btn" style="background-color: #42cd65; color: #fff" onclick="window.location.href = '/editProfile'" name="" value="Edit Profile"/><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-work">
                            <p>DATA ANALYSIS</p>
                            <a href="">Won ({{Auth::User()->win}})</a><br/>
                            <a href="">Tie ({{Auth::User()->tie}})</a><br/>
                            <a href="">Loss ({{Auth::User()->loss}})</a>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Username</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{Auth::User()->username}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Name</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{Auth::User()->name}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Email</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{Auth::User()->email}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Quiz Participated</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{Auth::User()->taken}}</p>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </form>           
        </div>
    @endsection