@extends('layouts.public')

@section('content')
    <div class="login-container">
        <div id="login-box" class="login-box visible widget-box no-border">
            <div class="widget-body">
                <div class="widget-main">
                    <h4 class="header blue lighter bigger">
                        <i class="ace-icon fa fa-coffee green"></i>
                        Please Enter Your Information
                    </h4>

                    <div class="space-6"></div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <fieldset>
                            <label class="block clearfix">
                                        <span class="block input-icon input-icon-right">
                                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                            <i class="ace-icon fa fa-user"></i>
                                        </span>
                            </label>

                            <label class="block clearfix">
                                        <span class="block input-icon input-icon-right">
                                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required autocomplete="current-password">

                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                            <i class="ace-icon fa fa-lock"></i>
                                        </span>
                            </label>

                            <div class="space"></div>

                            <div class="clearfix">
                                <label class="inline">
                                    <input class="ace" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <span class="lbl"> Remember Me</span>
                                </label>

                                <button type="submit" class="width-35 pull-right btn btn-sm btn-primary">
                                    <i class="ace-icon fa fa-key"></i>
                                    <span class="bigger-110">Login</span>
                                </button>
                            </div>

                            <div class="space-4"></div>
                        </fieldset>
                    </form>


                </div><!-- /.widget-main -->

                <div class="toolbar clearfix">
                    <div>
                        @if (Route::has('password.request'))
                            <a class="forgot-password-link" href="{{ route('password.request') }}">
                                <i class="ace-icon fa fa-arrow-left"></i>
                                I forgot my password
                            </a>
                        @endif
                        </a>
                    </div>

                    <div>
                        @if (Route::has('register'))
                        <a href="{{ route('register') }}" data-target="#signup-box" class="user-signup-link">
                            I want to register
                            <i class="ace-icon fa fa-arrow-right"></i>
                        </a>
                        @endif
                    </div>
                </div>
            </div><!-- /.widget-body -->
        </div><!-- /.login-box -->
    </div>

    @include('auth.register') 
@endsection
