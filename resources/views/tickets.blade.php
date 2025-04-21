@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row min-vh-100">

    {{-- Sidebar (same as profile/passes) --}}
    <div class="col-md-2 d-none d-md-block bg-primary text-white sidebar py-4 shadow-sm">
      <div class="text-center px-3 py-3 mb-4"
           style="background-color:rgba(255,255,255,0.1);border-bottom:1px solid rgba(255,255,255,0.25);">
        <img src="/images/user.png" class="rounded-circle mb-2" width="60">
        <h6 class="mb-0 text-white">{{ auth()->user()->name }}</h6>
        <small class="text-light">Online</small>
      </div>
      <ul class="nav flex-column px-3">
        <li class="nav-item mb-2">
          <a class="nav-link text-white {{ request()->is('dashboard')?'fw-bold':'' }}"
             href="{{ route('dashboard') }}">
            <i class="bi bi-house-door-fill me-2"></i> Dashboard
          </a>
        </li>
        <li class="nav-item mb-2">
          <a class="nav-link text-white {{ request()->is('passes')?'fw-bold':'' }}"
             href="{{ route('passes') }}">
            <i class="bi bi-card-checklist me-2"></i> Passes
          </a>
        </li>
        <li class="nav-item mb-2">
          <a class="nav-link text-white {{ request()->is('tickets')?'fw-bold':'' }}"
             href="{{ route('tickets') }}">
            <i class="bi bi-ticket-detailed-fill me-2"></i> Tickets
          </a>
        </li>
        <li class="nav-item mb-2">
          <a class="nav-link text-white {{ request()->is('profile')?'fw-bold':'' }}"
             href="{{ route('profile') }}">
            <i class="bi bi-person-circle me-2"></i> Profile
          </a>
        </li>
        <li class="nav-item mt-4">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-danger w-100">Logout</button>
          </form>
        </li>
      </ul>
    </div>

    {{-- Main Content --}}
    <div class="col-md-10 py-4 px-5 bg-light">
      <h4 class="fw-bold text-primary mb-4">Available Terminals</h4>

      <div class="card">
        <div class="card-body p-0">
          <table class="table table-striped mb-0" id="ticketsTable">
            <thead style="background:#000;color:#fff;">
              <tr>
                <th>#</th>
                <th>City</th>
                <th>Terminal Info</th>
              </tr>
            </thead>
            <tbody>
              @foreach($terminals as $terminal)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $terminal->destination_city }}</td>
                  <td>{{ $terminal->terminal_info }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
  $(function(){
    $('#ticketsTable').DataTable();
  });
</script>
@endpush
