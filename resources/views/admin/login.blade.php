@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center fw-semibold">
                    Admin Login Panel
                </div>

                <div class="card-body">
                    {{-- Display login errors --}}
                    @if($errors->has('login'))
                        <div class="alert alert-danger">
                            {{ $errors->first('login') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.login.submit') }}">
                        @csrf

                        <div class="mb-3">
                            <input type="text" name="login" class="form-control" placeholder="Username/Email" required autofocus value="{{ old('login') }}">
                        </div>

                        <div class="mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" name="remember" class="form-check-input" id="rememberCheck" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="rememberCheck">Remember Me</label>
                        </div>

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-success fw-semibold">Login as Admin</button>
                        </div>
                    </form>
                </div>

                <div class="card-footer text-center bg-light">
                    <a href="{{ route('login') }}">Back to Customer Login</a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
