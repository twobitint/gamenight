@extends('layouts.basic')

@section('body')
<div class="container-fluid h-100">
    <div class="row align-items-center h-100">
        <div class="col mx-auto" style="max-width: 400px;">
            <div class="card">
                <div class="card-header">
                    Login
                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="col">
                            <a href="{{ url('auth/google') }}" class="btn btn-primary btn-google w-100" style="color: white; background-color: rgb(66, 133, 244);">
                                <i class="fa fa-google"></i>
                                Log in with Google
                            </a>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="col">
                            <a href="{{ url('auth/facebook') }}" class="btn btn-primary btn-facebook w-100" style="color: white; background-color: #4267b2;">
                                <i class="fa fa-facebook"></i>
                                Log in with Facebook
                            </a>
                        </div>
                    </li>
                </ul>

                <div class="card-body">

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col control-label">E-Mail Address</label>

                            <div class="col">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col control-label">Password</label>

                            <div class="col">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col">
                                <button type="submit" class="btn btn-primary w-100">
                                    Login
                                </button>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col">
                                <a class="btn btn-link w-100" href="{{ url('/password/reset') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>

                        <div class="form-group">
                                <div class="col text-center">
                                    No account?
                                    <a href="{{ url('/register') }}">
                                        Sign up
                                    </a>
                                </div>
                            </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
