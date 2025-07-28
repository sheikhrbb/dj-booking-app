@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="section-title position-relative text-center mb-5">
        <h6 class="text-uppercase text-primary mb-3" style="letter-spacing: 3px;">Forgot Password</h6>
        <h1 class="font-secondary display-4">Reset Your Password</h1>
        <i class="fas fa-unlock-alt text-dark"></i>
    </div>

    @if (session('status'))
        <div class="alert alert-success">
            Instructions have been sent to your mail. Check your email and reset password.
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>
                        @if ($error == __('auth.throttle'))
                            Please wait a moment before trying again.
                        @else
                            {{ $error }}
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('services.index') }}" class="btn btn-secondary mb-3">
                <i class="fas fa-arrow-left"></i> Back
            </a>
            <form method="POST" class="forgot-password-form bg-white p-4 rounded shadow-sm" action="{{ route('password.email') }}">
                @csrf
                <div class="form-group">
                    <label for="email" class="font-weight-bold">Email:</label>
                    <input id="email" type="email" placeholder="Your Email" name="email" class="form-control bg-secondary border-0 py-4 px-3" value="{{ old('email') }}" required autofocus>
                </div>
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success font-weight-bold px-5 py-2" data-loading="Sending...">
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        <span class="submit-text">Email Password Reset Link</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
