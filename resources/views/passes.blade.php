@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row min-vh-100">
    
    {{-- Sidebar (same as profile) --}}
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
            <i class="bi bi-ticket-detailed-fill me-2"></i> Terminals
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
      <h4 class="fw-bold text-primary mb-4">My Passes</h4>

      {{-- success / price-alert --}}
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      {{-- Add Pass Form --}}
      <p>
        <button class="btn btn-success" data-bs-toggle="collapse" data-bs-target="#addPass">
          Add New Pass
        </button>
      </p>
      <div class="collapse mb-4" id="addPass">
        <div class="card card-body">
          <form id="passForm" action="{{ route('passes.store') }}" method="POST">
            @csrf
            <div class="row g-3">
              <div class="col-md-3">
                <label class="form-label">Start Date</label>
                <input type="date" name="start_date" class="form-control" required>
              </div>
              <div class="col-md-3">
                <label class="form-label">End Date</label>
                <input type="date" name="end_date" class="form-control" required>
              </div>
              <div class="col-md-3">
                <label class="form-label">Origin</label>
                <select id="origin" class="form-select" required>
                  <option value="">– Choose Origin –</option>
                  @foreach($terminals as $t)
                    <option value="{{ $t->id }}">{{ $t->destination_city }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-3">
                <label class="form-label">Destination</label>
                <select id="destination" class="form-select" required>
                  <option value="">– Choose Destination –</option>
                  @foreach($terminals as $t)
                    <option value="{{ $t->id }}">{{ $t->destination_city }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-4">
                <label class="form-label">Available Schedules</label>
                <select id="schedule" name="schedule_id" class="form-select" required>
                  <option value="">– Select Schedule –</option>
                </select>
              </div>
              <div class="col-md-2">
                <label class="form-label">Bus</label>
                <input type="text" id="busInfo" class="form-control" readonly>
              </div>
              <div class="col-md-2">
                <label class="form-label">Price</label>
                <input type="text" id="schedPrice" class="form-control" readonly>
              </div>
            </div>
            <button class="btn btn-success mt-3">Add Pass</button>
          </form>
        </div>
      </div>

      {{-- Passes Table --}}
      <div class="card">
        <div class="card-body p-0">
          <table class="table table-striped mb-0" id="passesTable">
            <thead style="background:#000;color:#fff;">
              <tr>
                <th>#</th><th>Pass ID</th><th>Schedule</th>
                <th>Period</th><th>Price</th><th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($passes as $p)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $p->pass_code }}</td>
                  <td>{{ $p->schedule->schedule_code }}</td>
                  <td>{{ $p->start_date }}→{{ $p->end_date }}</td>
                  <td>${{ number_format($p->schedule->price,2) }}</td>
                  <td>
                    {{-- changed from <a> to <button> with data-id --}}
                    <button
                      class="btn btn-sm btn-primary view-pass"
                      data-id="{{ $p->id }}"
                    >View</button>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

      {{-- Pass Details Modal --}}
      <div class="modal fade" id="passModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header bg-primary text-white">
              <h5 class="modal-title">Pass Details</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <dl class="row">
                <dt class="col-sm-4">Pass ID</dt>
                <dd class="col-sm-8" id="m_pass_code"></dd>

                <dt class="col-sm-4">Passenger</dt>
                <dd class="col-sm-8" id="m_user"></dd>

                <dt class="col-sm-4">Period</dt>
                <dd class="col-sm-8" id="m_period"></dd>

                <dt class="col-sm-4">Route</dt>
                <dd class="col-sm-8" id="m_route"></dd>

                <dt class="col-sm-4">Schedule Code</dt>
                <dd class="col-sm-8" id="m_schedule"></dd>

                <dt class="col-sm-4">Departure – Arrival</dt>
                <dd class="col-sm-8" id="m_times"></dd>

                <dt class="col-sm-4">Bus</dt>
                <dd class="col-sm-8" id="m_bus"></dd>

                <dt class="col-sm-4">Price</dt>
                <dd class="col-sm-8" id="m_price"></dd>
              </dl>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
const apiUrl      = "{{ url('api/schedules') }}";
const passShowUrl = "{{ url('passes') }}";

$(function(){
  $('#passesTable').DataTable();

  // Fetch schedules dropdown
  $('#origin, #destination').change(() => {
    let o = $('#origin').val(), d = $('#destination').val();
    $('#schedule').html('<option>Loading…</option>');
    if(o && d){
      $.get(apiUrl, {origin:o, destination:d}, schedules => {
        if(!schedules.length){
          alert('No schedule exists for that route.');
          $('#schedule').html('<option value="">– None –</option>');
          $('#schedPrice,#busInfo').val('');
          return;
        }
        let opts = ['<option value="">– Select Schedule –</option>'];
        schedules.forEach(s => {
          opts.push(`<option value="${s.id}">${s.schedule_code}</option>`);
        });
        $('#schedule').html(opts.join(''));
      });
    }
  });

  // Fill bus & price on schedule select
  $('#schedule').change(function(){
    let id = $(this).val();
    if(!id) return $('#schedPrice,#busInfo').val('');
    $.get(`${apiUrl}/${id}`, s => {
      $('#schedPrice').val('$'+parseFloat(s.price).toFixed(2));
      $('#busInfo').val(`${s.bus.bus_name} (${s.bus.bus_plate})`);
    });
  });

  // View button → load modal via AJAX
  $('.view-pass').click(function(){
    let pid = $(this).data('id');
    $.get(`${passShowUrl}/${pid}`, pass => {
      $('#m_pass_code').text(pass.pass_code);
      $('#m_user').text(`${pass.user.name} (${pass.user.email})`);
      $('#m_period').text(`${pass.start_date} → ${pass.end_date}`);
      $('#m_route').text(
        pass.schedule.origin.destination_city +
        ' → ' +
        pass.schedule.destination.destination_city
      );
      $('#m_schedule').text(pass.schedule.schedule_code);
      $('#m_times').text(
        pass.schedule.departure_time+' – '+pass.schedule.arrival_time
      );
      $('#m_bus').text(
        pass.schedule.bus.bus_name+' ('+pass.schedule.bus.bus_plate+')'
      );
      $('#m_price').text('$'+parseFloat(pass.schedule.price).toFixed(2));
      new bootstrap.Modal($('#passModal')).show();
    });
  });

  // ... existing code if any ...
});
</script>
@endpush
