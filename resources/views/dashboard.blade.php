@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row min-vh-100">
        {{-- Sidebar --}}
        <div class="col-md-2 d-none d-md-block bg-primary text-white sidebar py-4 shadow-sm">
            {{-- Profile Section --}}
            <div class="text-center px-3 py-3 mb-4" style="background-color: rgba(255, 255, 255, 0.1); border-bottom: 1px solid rgba(255, 255, 255, 0.25); box-shadow: inset 0 -1px 3px rgba(0,0,0,0.1);">
                <img src="/images/user.png" class="rounded-circle mb-2" width="60" alt="User">
                <h6 class="mb-0 text-white">{{ auth()->user()->name }}</h6>
                <small class="text-light">Online</small>
            </div>

            {{-- Sidebar Navigation --}}
            <ul class="nav flex-column px-3">
                <li class="nav-item mb-2">
                    <a class="nav-link text-white {{ request()->is('dashboard') ? 'fw-bold' : '' }}" href="{{ route('dashboard') }}">
                        <i class="bi bi-house-door-fill me-2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link text-white" href="#">
                        <i class="bi bi-card-checklist me-2"></i> Passes
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link text-white" href="#">
                        <i class="bi bi-ticket-detailed-fill me-2"></i> Tickets
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link text-white" href="#">
                        <i class="bi bi-envelope-fill me-2"></i> Enquiry
                    </a>
                </li>
                <li class="nav-item mt-4">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-danger w-100" type="submit">Logout</button>
                    </form>
                </li>
            </ul>
        </div>

        {{-- Main Dashboard Content --}}
        <div class="col-md-10 py-4 px-5 bg-light">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="fw-bold text-primary">Dashboard</h4>
                    <p class="text-muted">Overview of your travel & pass activity</p>
                </div>
                <input type="text" class="form-control w-25" placeholder="Search...">
            </div>

            {{-- Stat Cards --}}
            <div class="row g-4 mb-5">
                <div class="col-md-3">
                    <div class="bg-primary text-white rounded p-4 shadow-sm text-center">
                        <h6 class="text-white-50">Total Passes</h6>
                        <h3 class="fw-bold">4</h3>
                        <small class="text-white-50">+1 today</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="bg-success text-white rounded p-4 shadow-sm text-center">
                        <h6 class="text-white-50">Tickets Bought</h6>
                        <h3 class="fw-bold">6</h3>
                        <small class="text-white-50">+2 this week</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="bg-info text-white rounded p-4 shadow-sm text-center">
                        <h6 class="text-white-50">Enquiries Sent</h6>
                        <h3 class="fw-bold">2</h3>
                        <small class="text-white-50">0 pending</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="bg-primary text-white rounded p-4 shadow-sm text-center">
                        <h6 class="text-white-50">Passes This Week</h6>
                        <h3 class="fw-bold">3</h3>
                        <small class="text-white-50">+1 from last week</small>
                    </div>
                </div>
            </div>

            {{-- Activity & Notifications --}}
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="bg-white rounded shadow-sm p-4">
                        <h6 class="fw-bold mb-3">Daily Activity</h6>
                        <p class="text-muted">Coming soon: chart showing pass/ticket activity.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="bg-white rounded shadow-sm p-4">
                        <h6 class="fw-bold mb-3">Latest Notifications</h6>
                        <ul class="list-unstyled mb-0 text-muted small">
                            <li>✓ Your enquiry was replied to</li>
                            <li>✓ Your new pass has been approved</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
