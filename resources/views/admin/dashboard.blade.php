@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row min-vh-100">
        {{-- Admin Sidebar --}}
        <div class="col-md-2 d-none d-md-block bg-primary text-white sidebar py-4 shadow-sm">
            <div class="text-center px-3 py-3 mb-4" style="background-color: rgba(255,255,255,0.1); border-bottom: 1px solid rgba(255,255,255,0.25);">
                <img src="/images/admin.png" class="rounded-circle mb-2" width="60" alt="Admin">
                <h6 class="mb-0">{{ auth()->user()->name }}</h6>
                <small class="text-light">Admin Panel</small>
            </div>

            <ul class="nav flex-column px-3">
                <li class="nav-item mb-2">
                    <a class="nav-link text-white fw-bold" href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link text-white" href="#">
                        <i class="bi bi-building me-2"></i> Terminal View
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link text-white" href="#">
                        <i class="bi bi-people-fill me-2"></i> Users View
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link text-white" href="#">
                        <i class="bi bi-bar-chart-line-fill me-2"></i> Reports View
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link text-white" href="#">
                        <i class="bi bi-ticket-detailed-fill me-2"></i> Tickets View
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link text-white" href="#">
                        <i class="bi bi-bus-front-fill me-2"></i> Bus Pass View
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
            <h4 class="fw-bold text-primary mb-4">Admin Dashboard</h4>
            <div class="alert alert-info">
                Welcome to the admin dashboard. Select a view from the sidebar to manage the system.
            </div>
        </div>
    </div>
</div>
@endsection
