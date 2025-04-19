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
          <a class="nav-link text-white " href="{{ route('admin.dashboard') }}">
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
          <a class="nav-link text-white fw-bold" href="{{ route('admin.buses') }}">
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
      <h4 class="fw-bold text-primary mb-4">Bus Management</h4>

      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      {{-- Add Bus --}}
      <p>
        <button class="btn btn-success" data-bs-toggle="collapse" data-bs-target="#addBus">Add Bus</button>
      </p>
      <div class="collapse mb-4" id="addBus">
        <div class="card card-body">
          <form action="{{ route('admin.buses.store') }}" method="POST">
            @csrf
            <div class="row g-3">
              <div class="col-md-4">
                <label class="form-label">Bus Name</label>
                <input type="text" name="bus_name" class="form-control" required>
              </div>
              <div class="col-md-4">
                <label class="form-label">Bus Plate</label>
                <input type="text" name="bus_plate" class="form-control" required>
              </div>
              <div class="col-md-2">
                <label class="form-label">Seat Capacity</label>
                <input type="number" name="seat_capacity" class="form-control" min="1" required>
              </div>
              <div class="col-md-2">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                  <option>Active</option>
                  <option>Inactive</option>
                </select>
              </div>
            </div>
            <button class="btn btn-success mt-3">Save Bus</button>
          </form>
        </div>
      </div>

      {{-- Buses Table --}}
      <div class="card">
        <div class="card-body p-0">
          <table class="table table-striped mb-0" id="busesTable">
            <thead style="background-color:#000; color:#fff;">
              <tr>
                <th>#</th><th>Code</th><th>Name</th>
                <th>Plate</th><th>Capacity</th><th>Status</th><th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($buses as $bus)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $bus->bus_code }}</td>
                <td>{{ $bus->bus_name }}</td>
                <td>{{ $bus->bus_plate }}</td>
                <td>{{ $bus->seat_capacity }}</td>
                <td>
                  <span class="badge bg-{{ $bus->status=='Active'?'success':'secondary' }}">
                    {{ $bus->status }}
                  </span>
                </td>
                <td>
                  <button class="btn btn-sm btn-primary viewBus" data-id="{{ $bus->id }}">
                    View
                  </button>
                  <button class="btn btn-sm btn-warning editBus" data-id="{{ $bus->id }}">
                    Edit
                  </button>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>
</div>

{{-- VIEW Modal --}}
<div class="modal fade" id="busViewModal" tabindex="-1">
  <div class="modal-dialog"><div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Bus Details</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    </div>
    <div class="modal-body">
      <ul class="list-unstyled mb-0">
        <li><strong>Code:</strong> <span id="v_code"></span></li>
        <li><strong>Name:</strong> <span id="v_name"></span></li>
        <li><strong>Plate:</strong> <span id="v_plate"></span></li>
        <li><strong>Capacity:</strong> <span id="v_capacity"></span></li>
        <li><strong>Status:</strong> <span id="v_status"></span></li>
      </ul>
    </div>
  </div></div>
</div>

{{-- EDIT Modal --}}
<div class="modal fade" id="busEditModal" tabindex="-1">
  <div class="modal-dialog"><div class="modal-content">
    <form id="editBusForm" method="POST">
      @csrf @method('PUT')
      <div class="modal-header">
        <h5 class="modal-title">Edit Bus</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="e_id">
        <div class="mb-3">
          <label class="form-label">Bus Name</label>
          <input type="text" name="bus_name" id="e_name" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Bus Plate</label>
          <input type="text" name="bus_plate" id="e_plate" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Seat Capacity</label>
          <input type="number" name="seat_capacity" id="e_capacity" class="form-control" min="1" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Status</label>
          <select name="status" id="e_status" class="form-select">
            <option>Active</option>
            <option>Inactive</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary">Save Changes</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </form>
  </div></div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
  const baseUrl = "{{ url('admin/buses') }}";

  $(function(){
    $('#busesTable').DataTable();

    // VIEW
    $('.viewBus').click(function(){
      let id = $(this).data('id');
      $.get(`${baseUrl}/${id}`, bus => {
        $('#v_code').text(bus.bus_code);
        $('#v_name').text(bus.bus_name);
        $('#v_plate').text(bus.bus_plate);
        $('#v_capacity').text(bus.seat_capacity);
        $('#v_status').text(bus.status);
        new bootstrap.Modal($('#busViewModal')).show();
      });
    });

    // EDIT
    $('.editBus').click(function(){
      let id = $(this).data('id');
      $.get(`${baseUrl}/${id}`, bus => {
        $('#e_id').val(bus.id);
        $('#e_name').val(bus.bus_name);
        $('#e_plate').val(bus.bus_plate);
        $('#e_capacity').val(bus.seat_capacity);
        $('#e_status').val(bus.status);
        $('#editBusForm').attr('action', `${baseUrl}/${bus.id}`);
        new bootstrap.Modal($('#busEditModal')).show();
      });
    });
  });
</script>
@endpush
