@extends('layouts.public')

@section('content')
<div class="login-container">
    <div class="login-box visible widget-box no-border">
        <div class="widget-body">
            <div class="widget-main">
                <h4 class="header blue lighter bigger">
                    <i class="ace-icon fa fa-coffee green"></i>
                    {{ __('Reset Password') }}
                </h4>
                <div class="space-6"></div>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <p><strong>{{ __('E-Mail Address') }} </strong></p>

                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif

                    <div class="space"></div>

                    <div class="clearfix">

                        <button type="submit" class="pull-right btn btn-sm btn-primary">
                                {{ __('Send Password Reset Link') }}
                            </button>
                    </div>

                </form>
            </div>

            <div class="toolbar clearfix">
                <div>
                    <a href="{{ route('login') }}" class="forgot-password-link">
                        <i class="ace-icon fa fa-arrow-left"></i>
                        Back to login
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
