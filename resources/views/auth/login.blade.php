@extends('layouts.app')
{{--@section('content')--}}
<!DOCTYPE html>
<html>
    <head>
        <title>Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    </head>

    <body>

    <section class="login-area">
        <div class="container-fluid">
            <div class="row m-0">
                <div class="col-sm-8 p-0">
                    <div class="login-lhs">
                        <div class="tagline">Governance <span>Innovation Model</span></div>
                        <div class="welcome-msg">
                            Welcome!
                            <span>It is a long established fact that a reader will be distracted by the readable
content of a page when looking at its layout.</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 login-rhs p-0">
                    <div class="login-form-area">
                        <h2>Login</h2>
                        <p>Login with your username & password</p>

                        <form class="form-horizontal" method="POST" action="{{ route('login') }}">

                            {{ csrf_field() }}
                            <div class="login-form">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input id="email" type="email" class="form-control" name="email" class="form-control" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                   <strong>{{ $errors->first('email') }}</strong>
                            </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Password</label>
                                    <input id="password" type="password" class="form-control" name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="row form-group">
                                    <div class="col-sm-6">
                                        <label class="checkbox-area">Remember me
                                            <input type="checkbox" checked="checked">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>

                                    <div class="col-sm-6 text-right">
                                        <button class="btn btn-primary">Login</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script type="text/javascript" src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    </body>
{{--@endsection--}}