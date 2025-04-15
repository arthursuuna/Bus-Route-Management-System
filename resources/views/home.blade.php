@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<section class="hero d-flex align-items-center text-white" style="min-height: 90vh;">
    <div class="container text-center">
        <h1 class="display-4 fw-bold mb-3">Bus Pass and Route Management System</h1>
        <p class="lead mb-4">
            Now finding bus tickets is easier. You can order online at BPRMS — no need to go to a terminal or agent. Fast, simple, and secure.
            <br>Choose Seats. Cheapest Every Day. 24/7 Support. All  Routes.
        </p>
        {{-- <a href="{{ route('bookings') }}" class="btn btn-danger btn-lg px-4">Search Tickets</a> --}}
    </div>
</section>

<!-- Steps Section -->
<section class="py-5 bg-light">
    <div class="container text-center">
        <h2 class="mb-5 fw-semibold">Steps to Book a Bus Ticket</h2>
        <div class="row g-5 justify-content-center">
            <div class="col-md-4">
                <img src="/images/icon-trip.png" class="img-fluid mb-3" style="height: 80px;" alt="Select trip details">
                <h5 class="fw-bold">Select trip details</h5>
                <p class="text-muted">Enter your departure, destination, and travel date, then click 'Search'.</p>
            </div>
            <div class="col-md-4">
                <img src="/images/icon-seat.png" class="img-fluid mb-3" style="height: 80px;" alt="Choose seat">
                <h5 class="fw-bold">Choose your bus and seat</h5>
                <p class="text-muted">Select the bus, your seat, and input your details to continue.</p>
            </div>
            <div class="col-md-4">
                <img src="/images/icon-payment.png" class="img-fluid mb-3" style="height: 80px;" alt="Payment method">
                <h5 class="fw-bold">Easy Payment Method</h5>
                <p class="text-muted">Pay via ATM transfer, mobile money, or internet banking.</p>
            </div>
        </div>
    </div>
</section>

@endsection
