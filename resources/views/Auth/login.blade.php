@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">

            <div class="card shadow-sm">
                <div class="card-header bg-light text-center fw-semibold">
                    Customer Login Panel
                </div>

                <div class="card-body">
                    {{-- Display error if login fails --}}
                    @if($errors->has('login'))
                        <div class="alert alert-danger">
                            {{ $errors->first('login') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        {{-- Username or Email --}}
                        <div class="mb-3">
                            <input type="text" name="login" class="form-control" placeholder="Username/Email" required autofocus value="{{ old('login') }}">
                        </div>

                        {{-- Password --}}
                        <div class="mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>

                        {{-- Remember Me --}}
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="remember" class="form-check-input" id="rememberCheck" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="rememberCheck">Remember Password</label>
                        </div>

                        {{-- Submit Button --}}
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-success fw-semibold">Login as Customer</button>
                        </div>
                    </form>
                </div>

                <div class="card-footer text-center bg-light">
                    <a href="{{ route('register') }}">Register Now</a>
                    <hr>
                    <a href="{{ route('admin.login') }}">Login as Admin</a> {{-- Replace route if needed --}}
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
