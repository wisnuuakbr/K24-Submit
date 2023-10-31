@extends('layouts.auth')
@section('content')
    <style>
        .underline-text {
            text-decoration: underline;
            color: black;
        }
    </style>
    <div class="card">
        <div class="card-body">
            <div class="p-3">
                <div class="mb-4 text-center">
                    <h4 class="title">Login to your Account</h4>
                    <p class="text-muted">Get started with our app, just create an account and enjoy the
                        experience.
                    </p>
                </div>
                <form class="form-horizontal" action="{{ url('/login') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email" placeholder="Masukkan Email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                            required id="password" placeholder="Masukkan Password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group row m-t-30">
                        <div class="col-sm-6">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customControlInline">
                                <label class="custom-control-label" for="customControlInline">Remember me</label>
                            </div>
                        </div>
                        <div class="col-sm-6 text-right">
                            <a href="{{ route('password.request') }}" class="text-muted"><i class="mdi mdi-lock"></i> Forgot
                                your password?</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block w-md waves-effect waves-light" name="remember"
                            value="1" type="submit">Sign
                            In</button>
                    </div>
                    <p class="text-center">Don't have an account ? <a href="{{ route('register') }}"
                            class="text-info font-weight-bold"> Signup Now </a>
                    </p>
                    <div class="text-center mt-4">
                        <a href="#" class="underline-text">Term of use &amp; Conditions</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="m-t-40 text-center text-white-50">
        @include('layouts.footer')
    </div>
@endsection
