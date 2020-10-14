@extends('layouts.app')

@section('content')
  <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="{{url('/')}}/login-assets/images/img-01.png" alt="IMG">
                </div>

                <form class="login100-form validate-form" method="POST" action="{{ route('register') }}">
                    @csrf
                    <span class="login100-form-title">
                        Member Registration
                    </span>

                     <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                        <input class="input100" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <!-- <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span> -->
                    </div>

                    <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                        <input class="input100"  id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <!-- <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span> -->
                    </div>

                    <div class="wrap-input100 validate-input" data-validate = "Password is required">
                        <input class="input100" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                          @error('password')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        <!-- <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span> -->
                    </div>

                      <div class="wrap-input100 validate-input" data-validate = "Password is required">
                        <input class="input100" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

                        <!-- <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span> -->
                    </div>
                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">User Type</label>
                        <div class="col-md-6">
                            <select class="form-control" name="user_type" required>
                                <option value="">Select One</option>
                                <option value="admin">Admin</option>
                                <option value="stuff">Stuff</option>
                                <option value="customer">Customer</option>
                            </select>
                        </div>
                    </div>
                    <div class="container-login100-form-btn">

                         <button type="submit" class="login100-form-btn">
                              {{ __('Register') }}
                          </button>
                        <!-- <button class="login100-form-btn">
                            Login
                        </button> -->
                    </div>

                    <!-- <div class="text-center p-t-12">
                        <span class="txt1">
                            Forgot
                        </span>
                        <a class="txt2" href="#">
                            Username / Password?
                        </a>
                    </div>

                    <div class="text-center p-t-136">
                        <a class="txt2" href="{{route('register')}}">
                            Create your Account
                            <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                        </a>
                    </div> -->
                </form>
            </div>
        </div>
    </div>
@endsection
