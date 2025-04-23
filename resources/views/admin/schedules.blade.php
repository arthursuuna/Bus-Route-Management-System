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
            <i class="bi bi-building me-2"></i> Terminals
          </a>
        </li>
        <li class="nav-item mb-2">
          <a class="nav-link text-white fw-bold" href="{{ route('admin.schedules') }}">
            <i class="bi bi-people-fill me-2"></i>  Schedules
          </a>
        </li>
        {{-- <li class="nav-item mb-2">
          <a class="nav-link text-white" href="{{ route('admin.reports') }}">
            <i class="bi bi-bar-chart-line-fill me-2"></i> Reports View
          </a>
        </li> --}}
        <li class="nav-item mb-2">
          <a class="nav-link text-white" href="{{ route('admin.tickets') }}">
            <i class="bi bi-ticket-detailed-fill me-2"></i>Users' Passes
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
      <h4 class="fw-bold text-primary mb-4">Schedule Management</h4>

      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      {{-- Add Schedule --}}
      <p>
        <button class="btn btn-success" data-bs-toggle="collapse" data-bs-target="#addSched">
          Add Schedule
        </button>
      </p>
      <div class="collapse mb-4" id="addSched">
        <div class="card card-body">
          <form action="{{ route('admin.schedules.store') }}" method="POST">
            @csrf
            <div class="row g-3">
              <div class="col-md-3">
                <label class="form-label">Origin</label>
                <select name="origin_terminal_id" class="form-select" required>
                  <option value="">– Choose Origin –</option>
                  @foreach($terminals as $t)
                    <option value="{{ $t->id }}">{{ $t->destination_city }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-3">
                <label class="form-label">Destination</label>
                <select name="destination_terminal_id" class="form-select" required>
                  <option value="">– Choose Destination –</option>
                  @foreach($terminals as $t)
                    <option value="{{ $t->id }}">{{ $t->destination_city }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-3">
                <label class="form-label">Bus</label>
                <select name="bus_id" class="form-select" required>
                  <option value="">– Choose Bus –</option>
                  @foreach($buses as $b)
                    <option value="{{ $b->id }}">{{ $b->bus_name }} ({{ $b->bus_plate }})</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-3">
                <label class="form-label">Price</label>
                <input type="number" name="price" class="form-control" step="0.01" required>
              </div>

              <div class="col-md-3">
                <label class="form-label">Departure</label>
                <input type="time" name="departure_time" class="form-control" required>
              </div>
              <div class="col-md-3">
                <label class="form-label">Arrival</label>
                <input type="time" name="arrival_time" class="form-control" required>
              </div>
            </div>
            <button class="btn btn-success mt-3">Save Schedule</button>
          </form>
        </div>
      </div>

      {{-- Schedules Table --}}
      <div class="card">
        <div class="card-body p-0">
          <table class="table table-striped mb-0" id="schedTable">
            <thead style="background:#000;color:#fff;">
              <tr>
                <th>#</th>
                <th>Code</th>
                <th>Origin</th>
                <th>Destination</th>
                <th>Departure</th>
                <th>Arrival</th>
                <th>Price</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($schedules as $s)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $s->schedule_code }}</td>
                <td>{{ $s->origin->destination_city }}</td>
                <td>{{ $s->destination->destination_city }}</td>
                <td>{{ \Carbon\Carbon::parse($s->departure_time)->format('H:i') }}</td>
                <td>{{ \Carbon\Carbon::parse($s->arrival_time)->format('H:i') }}</td>
                <td>${{ number_format($s->price,2) }}</td>
                <td>
                  <button class="btn btn-sm btn-primary viewSched" data-id="{{ $s->id }}">
                    View
                  </button>
                  <button class="btn btn-sm btn-warning editSched" data-id="{{ $s->id }}">
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

{{-- View Modal --}}
<div class="modal fade" id="schedViewModal" tabindex="-1">
  <div class="modal-dialog"><div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Schedule Details</h5>
      <button class="btn-close" data-bs-dismiss="modal"></button>
    </div>
    <div class="modal-body">
      <ul class="list-unstyled mb-0">
        <li><strong>Code:</strong> <span id="sv_code"></span></li>
        <li><strong>Origin:</strong> <span id="sv_origin"></span></li>
        <li><strong>Destination:</strong> <span id="sv_dest"></span></li>
        <li><strong>Bus:</strong> <span id="sv_bus"></span></li>
        <li><strong>Departure:</strong> <span id="sv_dep"></span></li>
        <li><strong>Arrival:</strong> <span id="sv_arr"></span></li>
        <li><strong>Price:</strong> $<span id="sv_price"></span></li>
      </ul>
    </div>
  </div></div>
</div>

{{-- Edit Modal --}}
<div class="modal fade" id="schedEditModal" tabindex="-1">
  <div class="modal-dialog"><div class="modal-content">
    <form id="editSchedForm" method="POST">
      @csrf @method('PUT')
      <div class="modal-header">
        <h5 class="modal-title">Edit Schedule</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="e_sid">

        <div class="mb-3">
          <label class="form-label">Origin</label>
          <select id="e_origin" name="origin_terminal_id" class="form-select" required>
            <option value="">– Choose Origin –</option>
            @foreach($terminals as $t)
              <option value="{{ $t->id }}">{{ $t->destination_city }}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Destination</label>
          <select id="e_dest" name="destination_terminal_id" class="form-select" required>
            <option value="">– Choose Destination –</option>
            @foreach($terminals as $t)
              <option value="{{ $t->id }}">{{ $t->destination_city }}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Bus</label>
          <select id="e_bus" name="bus_id" class="form-select" required>
            <option value="">– Choose Bus –</option>
            @foreach($buses as $b)
              <option value="{{ $b->id }}">{{ $b->bus_name }} ({{ $b->bus_plate }})</option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Departure</label>
          <input type="time" id="e_dep" name="departure_time" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Arrival</label>
          <input type="time" id="e_arr" name="arrival_time" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Price</label>
          <input type="number" id="e_price" name="price" class="form-control" step="0.01" required>
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
  const schedUrl = "{{ url('admin/schedules') }}";

  $(function(){
    $('#schedTable').DataTable();

    // VIEW
    $('.viewSched').click(function(){
      let id = $(this).data('id');
      $.get(`${schedUrl}/${id}`, s=>{
        $('#sv_code').text(s.schedule_code);
        $('#sv_origin').text(s.origin.destination_city);
        $('#sv_dest').text(s.destination.destination_city);
        $('#sv_bus').text(s.bus.bus_name+' ('+s.bus.bus_plate+')');
        $('#sv_dep').text(s.departure_time);
        $('#sv_arr').text(s.arrival_time);
        $('#sv_price').text(parseFloat(s.price).toFixed(2));
        new bootstrap.Modal($('#schedViewModal')).show();
      });
    });

    // EDIT
    $('.editSched').click(function(){
      let id = $(this).data('id');
      $.get(`${schedUrl}/${id}`, s=>{
        $('#e_sid').val(s.id);
        $('#e_origin').val(s.origin_terminal_id);
        $('#e_dest').val(s.destination_terminal_id);
        $('#e_bus').val(s.bus_id);
        $('#e_dep').val(s.departure_time);
        $('#e_arr').val(s.arrival_time);
        $('#e_price').val(s.price);
        $('#editSchedForm').attr('action', `${schedUrl}/${s.id}`);
        new bootstrap.Modal($('#schedEditModal')).show();
      });
    });
  });
</script>
@endpush
