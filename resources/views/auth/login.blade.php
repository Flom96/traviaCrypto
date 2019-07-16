@extends('layout.navbar')
    @section('content')
    <?php
        $id = 'login';
    ?>
        <div class="bg-parallax parallax-overlay accounts-page"  data-jarallax='{"speed": 0.2}' style='background-image: url("/images/bg6.jpg")'>
            <div class="container">
                <div class="row pb30">
                    <div class="col-lg-4 col-md-6 mr-auto ml-auto col-sm-8">
                        <h3 class="text-white text-center mb30">Login to continue</h3>
                        <form method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Username" name="username" value="{{ old('username') }}" required>
                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
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
                                  <button type="submit" class="btn btn-rounded btn-primary btn-block">Sign In</button>
                            </div>
                            
                            <hr>
                            <div>
                                <a href="/register" class="btn btn-white-outline btn-block">Sign Up</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection    