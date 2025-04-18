@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm">
                <div class="card-header bg-light fw-semibold">
                    Customer Registration
                </div>
                <div class="card-body">
                    <form action="{{ route('register') }}" method="POST">
                        @csrf

                        {{-- Full Name --}}
                        <div class="mb-3">
                            <input type="text" name="name" class="form-control" placeholder="Full Name" required>
                        </div>

                        {{-- Email and Contact --}}
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <input type="email" name="email" class="form-control" placeholder="Email" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="contact_number" class="form-control" placeholder="Contact Number" required>
                            </div>
                        </div>

                        {{-- Address --}}
                        <div class="mb-3">
                            <textarea name="address" class="form-control" rows="2" placeholder="Address" required></textarea>
                        </div>

                        {{-- Username --}}
                        <div class="mb-3">
                            <input type="text" name="username" class="form-control" placeholder="Username" required>
                        </div>

                        {{-- Password and Confirm --}}
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <input type="password" name="password" class="form-control" placeholder="Password" required>
                            </div>
                            <div class="col-md-6">
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Repeat Password" required>
                            </div>
                        </div>

                        {{-- Register Button --}}
                        <div class="d-grid">
                            <button type="submit" class="btn btn-info text-white fw-semibold">Register</button>
                        </div>
                    </form>
                </div>

                <div class="card-footer text-center bg-light">
                    Already Registered? <a href="{{ route('login') }}">Login Now</a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
