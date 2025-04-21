{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row min-vh-100">
    {{-- Sidebar --}}
    <div class="col-md-2 d-none d-md-block bg-primary text-white sidebar py-4 shadow-sm">
      <div class="text-center px-3 py-3 mb-4"
           style="background-color: rgba(255,255,255,0.1); border-bottom:1px solid rgba(255,255,255,0.25);">
        <img src="/images/user.png" class="rounded-circle mb-2" width="60" alt="User">
        <h6 class="mb-0 text-white">{{ auth()->user()->name }}</h6>
        <small class="text-light">Online</small>
      </div>
      <ul class="nav flex-column px-3">
        <li class="nav-item mb-2">
          <a class="nav-link text-white {{ request()->is('dashboard') ? 'fw-bold' : '' }}"
             href="{{ route('dashboard') }}">
            <i class="bi bi-house-door-fill me-2"></i> Dashboard
          </a>
        </li>
        <li class="nav-item mb-2">
          <a class="nav-link text-white {{ request()->is('passes') ? 'fw-bold' : '' }}"
             href="{{ route('passes') }}">
            <i class="bi bi-card-checklist me-2"></i> Passes
          </a>
        </li>
        <li class="nav-item mb-2">
          <a class="nav-link text-white {{ request()->is('tickets') ? 'fw-bold' : '' }}"
             href="{{ route('tickets') }}">
            <i class="bi bi-building me-2"></i> Terminals
          </a>
        </li>
        <li class="nav-item mb-2">
          <a class="nav-link text-white {{ request()->is('profile') ? 'fw-bold' : '' }}"
             href="{{ route('profile') }}">
            <i class="bi bi-person-circle me-2"></i> Profile
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

    {{-- Main Content --}}
    <div class="col-md-10 py-4 px-5 bg-light">
      <h4 class="fw-bold text-primary mb-4">Dashboard</h4>
      <p class="text-muted mb-5">Quick links and info to get you moving.</p>

      <div class="row g-4">
        {{-- Welcome Box --}}
        <div class="col-md-6 col-lg-3">
          <div class="bg-primary text-white rounded p-4 shadow-sm text-center">
            <h5 class="mb-3">Welcome Back!</h5>
            <p class="mb-0">Hi {{ auth()->user()->name }}, glad you’re here.</p>
          </div>
        </div>

        {{-- Add Pass --}}
        <div class="col-md-6 col-lg-3">
          <div class="bg-success text-white rounded p-4 shadow-sm text-center">
            <h5 class="mb-3">Get Your Pass</h5>
            <p class="mb-3">Purchase a monthly bus pass instantly.</p>
            <a href="{{ route('passes') }}" class="btn btn-light">Add Pass</a>
          </div>
        </div>

        {{-- View Terminals --}}
        <div class="col-md-6 col-lg-3">
          <div class="bg-info text-white rounded p-4 shadow-sm text-center">
            <h5 class="mb-3">View Terminals</h5>
            <p class="mb-3">See all bus terminals and routes.</p>
            <a href="{{ route('tickets') }}" class="btn btn-light">Terminals</a>
          </div>
        </div>

        {{-- Info Box --}}
        <div class="col-md-6 col-lg-3">
          <div class="bg-warning text-dark rounded p-4 shadow-sm text-center">
            <h5 class="mb-3">Need Assistance?</h5>
            <p class="mb-0">Visit our <a href="#" class="link-dark">Support Center</a> or email us at <a href="mailto:support@example.com" class="link-dark">busmgt@gmail.com</a>.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
