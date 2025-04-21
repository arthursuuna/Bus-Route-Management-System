@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row min-vh-100">

    {{-- Sidebar (same as dashboard) --}}
    <div class="col-md-2 d-none d-md-block bg-primary text-white sidebar py-4 shadow-sm">
      <div class="text-center px-3 py-3 mb-4" style="background-color:rgba(255,255,255,0.1);border-bottom:1px solid rgba(255,255,255,0.25);">
        <img src="/images/user.png" class="rounded-circle mb-2" width="60" alt="User">
        <h6 class="mb-0 text-white">{{ auth()->user()->name }}</h6>
        <small class="text-light">Online</small>
      </div>
      <ul class="nav flex-column px-3">
        <li class="nav-item mb-2">
          <a class="nav-link text-white {{ request()->is('dashboard') ? 'fw-bold' : '' }}" href="{{ route('dashboard') }}">
            <i class="bi bi-house-door-fill me-2"></i> Dashboard
          </a>
        </li>
        <li class="nav-item mb-2">
          <a class="nav-link text-white" href="{{ route('passes') }}">
            <i class="bi bi-card-checklist me-2"></i> Passes
          </a>
        </li>
        <li class="nav-item mb-2">
          <a class="nav-link text-white" href="{{ route('tickets') }}">
            <i class="bi bi-ticket-detailed-fill me-2"></i> Tickets
          </a>
        </li>
        {{-- Updated Profile link --}}
        <li class="nav-item mb-2">
          <a class="nav-link text-white {{ request()->is('profile') ? 'fw-bold' : '' }}" href="{{ route('profile') }}">
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
      <h4 class="fw-bold text-primary mb-4">My Profile</h4>

      {{-- Success message --}}
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <form action="{{ route('profile.update') }}" method="POST">
        @csrf @method('PUT')

        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Full Name</label>
            <input 
              type="text" 
              name="name" 
              class="form-control @error('name') is-invalid @enderror" 
              value="{{ old('name', $user->name) }}" 
              required
            >
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="col-md-6">
            <label class="form-label">Username</label>
            <input 
              type="text" 
              name="username" 
              class="form-control @error('username') is-invalid @enderror" 
              value="{{ old('username', $user->username) }}" 
              required
            >
            @error('username')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="col-md-6">
            <label class="form-label">Email</label>
            <input 
              type="email" 
              name="email" 
              class="form-control @error('email') is-invalid @enderror" 
              value="{{ old('email', $user->email) }}" 
              required
            >
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="col-md-6">
            <label class="form-label">Contact Number</label>
            <input 
              type="text" 
              name="contact_number" 
              class="form-control @error('contact_number') is-invalid @enderror" 
              value="{{ old('contact_number', $user->contact_number) }}"
            >
            @error('contact_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="col-12">
            <label class="form-label">Address</label>
            <textarea 
              name="address" 
              class="form-control @error('address') is-invalid @enderror" 
              rows="3"
            >{{ old('address', $user->address) }}</textarea>
            @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
        </div>

        <button class="btn btn-primary mt-4">Update Profile</button>
      </form>
    </div>
  </div>
</div>
@endsection
