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
          <a class="nav-link text-white fw-bold" href="{{ route('admin.terminals') }}">
            <i class="bi bi-building me-2"></i> Terminals
          </a>
        </li>
        <li class="nav-item mb-2">
          <a class="nav-link text-white" href="{{ route('admin.schedules') }}">
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
      <h4 class="fw-bold text-primary mb-4">Terminal View</h4>

      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      {{-- Add Destination --}}
      <p>
        <button class="btn btn-success" data-bs-toggle="collapse" data-bs-target="#addDest">
          Add Destination
        </button>
      </p>
      <div class="collapse mb-4" id="addDest">
        <div class="card card-body">
          <form action="{{ route('admin.terminals.store') }}" method="POST">
            @csrf
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Destination City</label>
                <input type="text" name="destination_city" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Terminal Info</label>
                <input type="text" name="terminal_info" class="form-control" required>
              </div>
            </div>
            <button class="btn btn-success mt-3">Save Destination</button>
          </form>
        </div>
      </div>

      {{-- Destinations Table --}}
      <div class="card">
        <div class="card-body p-0">
          <table class="table table-striped mb-0" id="termsTable">
            <thead style="background:#000;color:#fff;">
              <tr>
                <th>#</th>
                <th>Code</th>
                <th>Destination City</th>
                <th>Terminal Info</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($terminals as $term)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $term->terminal_code }}</td>
                <td>{{ $term->destination_city }}</td>
                <td>{{ $term->terminal_info }}</td>
                <td>
                  <button class="btn btn-sm btn-primary viewTerm" data-id="{{ $term->id }}">
                    View
                  </button>
                  <button class="btn btn-sm btn-warning editTerm" data-id="{{ $term->id }}">
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
<div class="modal fade" id="termViewModal" tabindex="-1">
  <div class="modal-dialog"><div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Destination Details</h5>
      <button class="btn-close" data-bs-dismiss="modal"></button>
    </div>
    <div class="modal-body">
      <ul class="list-unstyled mb-0">
        <li><strong>Code:</strong> <span id="tv_code"></span></li>
        <li><strong>City:</strong> <span id="tv_city"></span></li>
        <li><strong>Terminal:</strong> <span id="tv_info"></span></li>
      </ul>
    </div>
  </div></div>
</div>

{{-- Edit Modal --}}
<div class="modal fade" id="termEditModal" tabindex="-1">
  <div class="modal-dialog"><div class="modal-content">
    <form id="editTermForm" method="POST">
      @csrf @method('PUT')
      <div class="modal-header">
        <h5 class="modal-title">Edit Destination</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="e_tid">
        <div class="mb-3">
          <label class="form-label">Destination City</label>
          <input type="text" name="destination_city" id="e_city" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Terminal Info</label>
          <input type="text" name="terminal_info" id="e_info" class="form-control" required>
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
  const termUrl = "{{ url('admin/terminals') }}";

  $(function(){
    $('#termsTable').DataTable();

    // VIEW
    $('.viewTerm').click(function(){
      let id = $(this).data('id');
      $.get(`${termUrl}/${id}`, term => {
        $('#tv_code').text(term.terminal_code);
        $('#tv_city').text(term.destination_city);
        $('#tv_info').text(term.terminal_info);
        new bootstrap.Modal($('#termViewModal')).show();
      });
    });

    // EDIT
    $('.editTerm').click(function(){
      let id = $(this).data('id');
      $.get(`${termUrl}/${id}`, term => {
        $('#e_tid').val(term.id);
        $('#e_city').val(term.destination_city);
        $('#e_info').val(term.terminal_info);
        $('#editTermForm').attr('action', `${termUrl}/${id}`);
        new bootstrap.Modal($('#termEditModal')).show();
      });
    });
  });
</script>
@endpush


   