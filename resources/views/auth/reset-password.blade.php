@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="section-title position-relative text-center mb-5">
        <h6 class="text-uppercase text-primary mb-3" style="letter-spacing: 3px;">Reset Password</h6>
        <h1 class="font-secondary display-4">Set New Password</h1>
        <i class="fas fa-key text-dark"></i>
    </div>

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
            <form method="POST" class="reset-password-form bg-white p-4 rounded shadow-sm" action="{{ route('password.store') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="form-group">
                    <label for="email" class="font-weight-bold">Email:</label>
                    <input id="email" type="email" placeholder="Your Email" name="email" class="form-control bg-secondary border-0 py-4 px-3" value="{{ old('email', $request->email) }}" required autofocus>
                </div>
                <div class="form-group">
                    <label for="password" class="font-weight-bold">New Password:</label>
                    <input id="password" type="password" placeholder="New Password" name="password" class="form-control bg-secondary border-0 py-4 px-3" required>
                </div>
                <div class="form-group">
                    <label for="password_confirmation" class="font-weight-bold">Confirm Password:</label>
                    <input id="password_confirmation" placeholder="Confirm Password" type="password" name="password_confirmation" class="form-control bg-secondary border-0 py-4 px-3" required>
                </div>
                <div class="text-center mt-4">
                    <!-- <button type="submit" class="btn btn-success font-weight-bold px-5 py-2">Reset Password</button> -->
                    <button type="submit" class="btn btn-success font-weight-bold px-5 py-2" data-loading="Please wait...">
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        <span class="submit-text">Reset Password</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
