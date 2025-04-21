<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <style>
    body { font-family: DejaVu Sans, sans-serif; }
    .header { text-align: center; margin-bottom: 1em; }
    .details dt { float: left; clear: left; width: 120px; font-weight: bold; }
    .details dd { margin: 0 0 0.5em 130px; }
  </style>
</head>
<body>
  <div class="header">
    <h2>Bus Pass</h2>
    <h4>{{ $pass->pass_code }}</h4>
  </div>
  <dl class="details">
    <dt>Passenger:</dt><dd>{{ $pass->user->name }} ({{ $pass->user->email }})</dd>
    <dt>Period:</dt><dd>{{ $pass->start_date }} → {{ $pass->end_date }}</dd>
    <dt>Route:</dt>
      <dd>
        {{ $pass->schedule->origin->destination_city }}
         → {{ $pass->schedule->destination->destination_city }}
      </dd>
    <dt>Schedule:</dt><dd>{{ $pass->schedule->schedule_code }}</dd>
    <dt>Times:</dt>
      <dd>
        {{ \Carbon\Carbon::parse($pass->schedule->departure_time)->format('h:i A') }}
        – {{ \Carbon\Carbon::parse($pass->schedule->arrival_time)->format('h:i A') }}
      </dd>
    <dt>Bus:</dt>
      <dd>
        {{ $pass->schedule->bus->bus_name }}
        ({{ $pass->schedule->bus->bus_plate }})
      </dd>
    <dt>Price:</dt><dd>${{ number_format($pass->schedule->price,2) }}</dd>
  </dl>
</body>
</html>
