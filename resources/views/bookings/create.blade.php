@extends('layout.app')
@section('content')
    <h1>New Booking</h1>
    <form method="POST" action="{{ route('bookings.store') }}" onsubmit="return validateBooking()">
        @csrf
        @include('bookings._form')
        <button type="submit">Submit Booking</button>
    </form>
@endsection
