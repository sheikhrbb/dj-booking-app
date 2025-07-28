@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="section-title position-relative text-center mb-5">
        <h6 class="text-uppercase text-primary mb-3" style="letter-spacing: 3px;">Login</h6>
        <h1 class="font-secondary display-4">Sign In</h1>
        <i class="fas fa-sign-in-alt text-dark"></i>
    </div>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <a href="{{ route('dashboard') }}" class="btn btn-secondary mb-3">
                <i class="fas fa-arrow-left"></i> Back
            </a>
            <form method="POST" action="{{ route('login') }}" class="login-form bg-white p-4 rounded shadow-sm">
                @csrf
                <div class="form-group">
                    <label for="email" class="font-weight-bold">Email:</label>
                    <input id="email" placeholder="Your Email" type="email" name="email" class="form-control bg-secondary border-0 py-4 px-3" value="{{ old('email') }}" required autofocus autocomplete="username">
                </div>
                <div class="form-group">
                    <label for="password" class="font-weight-bold">Password:</label>
                    <input id="password" placeholder="Your Password" type="password" name="password" class="form-control bg-secondary border-0 py-4 px-3" required autocomplete="current-password">
                </div>
                <div class="form-group form-check">
                    <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                    <label for="remember_me" class="form-check-label">Remember me</label>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-4">
                    @if (Route::has('password.request'))
                        <a class="text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                    <!-- <button type="submit" class="btn btn-success font-weight-bold px-5 py-2">Log in</button> -->
                    <button type="submit" class="btn btn-success font-weight-bold px-5 py-2" data-loading="Please wait...">
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        <span class="submit-text">Log in</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


