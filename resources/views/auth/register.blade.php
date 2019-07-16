@extends('layout.navbar')
    @section('content')
    <?php
        $id = 'reg';
    ?>
    <div class="bg-parallax parallax-overlay accounts-page"  data-jarallax='{"speed": 0.2}' style='background-image: url("/images/bg6.jpg")'>
            <div class="container">
                <div class="row pb30 align-items-end">
                    <div class="col-lg-4 offset-lg-4  col-md-6 col-sm-6 mb20">
                        <h3 class="text-white text-left mb30">Join TriviaCrypto today.</h3>
                        <form method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Name" name="name" value="{{ old('name') }}" required>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Username" name="username" value="{{ old('username') }}" required>
                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Password" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-rounded btn-primary btn-block">Sign Up</button>
                            </div>
                            <div class="text-center text-white-gray">Already have an account? SignIn below</div>
                            <hr>
                            <div>
                                <a href="/login" class="btn btn-white-outline btn-block">Sign In</a>
                            </div>
                        </form>
                    </div>
                    <!-- <div class="col-lg-6 col-md-6 col-sm-6 mb20">
                        <h3 class="text-white text-left mb30">Sign Up with social hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh</h3>
                        <div class="clearfix">
                            <a href="#" class="social-icon-lg si-dark si-colored-facebook">
                                <i class="fa fa-facebook"></i>
                                <i class="fa fa-facebook"></i>
                            </a>
                            <a href="#" class="social-icon-lg  si-dark si-colored-twitter">
                                <i class="fa fa-twitter"></i>
                                <i class="fa fa-twitter"></i>
                            </a>
                            <a href="#" class="social-icon-lg si-dark si-colored-google-plus">
                                <i class="fa fa-google-plus"></i>
                                <i class="fa fa-google-plus"></i>
                            </a>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    @endsection