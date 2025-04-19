@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row min-vh-100">

    {{-- Sidebar --}}
    <div class="col-md-2 d-none d-md-block bg-primary text-white sidebar py-4 shadow-sm">
      <div class="text-center px-3 py-3 mb-4" style="background-color: rgba(255,255,255,0.1); border-bottom:1px solid rgba(255,255,255,0.25);">
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
          <a class="nav-link text-white" href="{{ route('admin.terminals') }}">
            <i class="bi bi-building me-2"></i> Terminal View
          </a>
        </li>
        <li class="nav-item mb-2">
          <a class="nav-link text-white" href="{{ route('admin.users') }}">
            <i class="bi bi-people-fill me-2"></i> Users View
          </a>
        </li>
        <li class="nav-item mb-2">
          <a class="nav-link text-white" href="{{ route('admin.reports') }}">
            <i class="bi bi-bar-chart-line-fill me-2"></i> Reports View
          </a>
        </li>
        <li class="nav-item mb-2">
          <a class="nav-link text-white" href="{{ route('admin.tickets') }}">
            <i class="bi bi-ticket-detailed-fill me-2"></i>Tickets Passes
          </a>
        </li>
        <li class="nav-item mb-2">
          <a class="nav-link text-white" href="{{ route('admin.buses') }}">
            <i class="bi bi-card-checklist me-2"></i>  Buses
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

      <div class="row g-4">
        <div class="col-md-4">
          <div class="bg-white shadow-sm rounded p-4 d-flex justify-content-between align-items-center border-start border-info border-4">
            <div>
              <h6 class="text-secondary text-uppercase mb-1">Total Terminals</h6>
              <h3 class="fw-bold text-dark">5</h3>
            </div>
            <i class="bi bi-signpost-split-fill fs-1 text-info"></i>
          </div>
        </div>

        <div class="col-md-4">
          <div class="bg-white shadow-sm rounded p-4 d-flex justify-content-between align-items-center border-start border-success border-4">
            <div>
              <h6 class="text-secondary text-uppercase mb-1">Total Tickets Sold</h6>
              <h3 class="fw-bold text-dark">14</h3>
            </div>
            <i class="bi bi-ticket-perforated-fill fs-1 text-success"></i>
          </div>
        </div>

        <div class="col-md-4">
          <div class="bg-white shadow-sm rounded p-4 d-flex justify-content-between align-items-center border-start border-primary border-4">
            <div>
              <h6 class="text-secondary text-uppercase mb-1">Available Schedules</h6>
              <h3 class="fw-bold text-dark">3</h3>
            </div>
            <i class="bi bi-calendar-check-fill fs-1 text-primary"></i>
          </div>
        </div>

        <div class="col-md-4">
          <div class="bg-white shadow-sm rounded p-4 d-flex justify-content-between align-items-center border-start border-warning border-4">
            <div>
              <h6 class="text-secondary text-uppercase mb-1">Available Buses</h6>
              <h3 class="fw-bold text-dark">6</h3>
            </div>
            <i class="bi bi-bus-front-fill fs-1 text-warning"></i>
          </div>
        </div>

        <div class="col-md-4">
          <div class="bg-white shadow-sm rounded p-4 d-flex justify-content-between align-items-center border-start border-success border-4">
            <div>
              <h6 class="text-secondary text-uppercase mb-1">Passes Approved</h6>
              <h3 class="fw-bold text-dark">10</h3>
            </div>
            <i class="bi bi-check-circle-fill fs-1 text-success"></i>
          </div>
        </div>

        <div class="col-md-4">
          <div class="bg-white shadow-sm rounded p-4 d-flex justify-content-between align-items-center border-start border-danger border-4">
            <div>
              <h6 class="text-secondary text-uppercase mb-1">New Enquiries</h6>
              <h3 class="fw-bold text-dark">2</h3>
            </div>
            <i class="bi bi-question-circle-fill fs-1 text-danger"></i>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection
