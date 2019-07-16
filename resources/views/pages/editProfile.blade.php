@extends('layout.navbar')
    @section('content')
    <link href="/css/profile.css" rel="stylesheet">
    	<div class="page-titles-img title-space-lg parallax-overlay bg-parallax" data-jarallax='{"speed": 0.4}' style='background-image: url("/images/bg13.jpg");background-position:top center;'>
            <div class="container">
                <div class="row">
                    <div class=" col-md-12">
                        <h1 class="text-uppercase">Edit Profile</h1>

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
                        <input type="button" class="profile-edit-btn" style="background-color: #42cd65; color: #fff;width:100% !important" onclick="window.location.href = '/changePassword'" name="" value="Change Password"/><br>
                    </div>
                </div>
            </form>
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
                                <form method="post" action="/update">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Username</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p><input class="edit-profile" type="text" name="username" value="{{Auth::User()->username}}" required></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Name</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p><input class="edit-profile" type="text" name="name" value="{{Auth::User()->name}}" required></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Email</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p><input class="edit-profile" type="email" name="email" value="{{Auth::User()->email}}" required></p>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" style="width: 100%; background-color: #4caf50; border: none;  color: white; padding: 16px 32px; text-decoration: none; margin-top: 50px; cursor: pointer;font-size: 16px;">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            
                        </div>
                    </div>
                </div>
                       
        </div>

        @if(session()->has('success'))
            <script>
                alert("{{ session()->get('success') }}");
            </script>
        @endif
    @endsection