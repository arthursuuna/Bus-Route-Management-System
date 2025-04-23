{{-- resources/views/admin/tickets.blade.php --}}
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
          <a class="nav-link text-white" href="{{ route('admin.dashboard') }}">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
          </a>
        </li>
        <li class="nav-item mb-2">
          <a class="nav-link text-white" href="{{ route('admin.terminals') }}">
            <i class="bi bi-building me-2"></i> Terminals
          </a>
        </li>
        <li class="nav-item mb-2">
          <a class="nav-link text-white" href="{{ route('admin.schedules') }}">
            <i class="bi bi-calendar-event me-2"></i>  Schedules
          </a>
        </li>
        {{-- <li class="nav-item mb-2">
          <a class="nav-link text-white" href="{{ route('admin.reports') }}">
            <i class="bi bi-bar-chart-line-fill me-2"></i> Reports View
          </a>
        </li> --}}
        <li class="nav-item mb-2">
          <a class="nav-link text-white fw-bold" href="{{ route('admin.tickets') }}">
            <i class="bi bi-ticket-detailed-fill me-2"></i> Users' Passes
          </a>
        </li>
        <li class="nav-item mb-2">
          <a class="nav-link text-white" href="{{ route('admin.buses') }}">
            <i class="bi bi-bus-front-fill me-2"></i> Buses
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
      <h4 class="fw-bold text-primary mb-4">Users’ Passes </h4>

      <div class="card">
        <div class="card-body p-0">
          <table class="table table-striped mb-0" id="adminPassesTable">
            <thead style="background:#000;color:#fff;">
              <tr>
                <th>#</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Pass ID</th>
                <th>Route</th>
                <th>Period</th>
                <th>Price</th>
              </tr>
            </thead>
            <tbody>
              @foreach($passes as $pass)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $pass->user->name }}</td>
                <td>{{ $pass->user->email }}</td>
                <td>{{ $pass->pass_code }}</td>
                <td>
                  {{ $pass->schedule->origin->destination_city }}
                  → {{ $pass->schedule->destination->destination_city }}
                </td>
                <td>{{ $pass->start_date }} → {{ $pass->end_date }}</td>
                <td>${{ number_format($pass->schedule->price, 2) }}</td>
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
    $('#adminPassesTable').DataTable({
      order: [[ 0, 'asc' ]],
      pageLength: 10,
      columns: [
        null, // #
        null, // name
        null, // email
        null, // pass id
        null, // route
        null, // period
        { orderable: false } // price
      ]
    });
  });
</script>
@endpush
