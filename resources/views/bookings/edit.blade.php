@extends('layout.app')
@section('content')
    <h1>Edit Booking</h1>
    <form method="POST" action="{{ route('bookings.update', $booking) }}" onsubmit="return validateBooking()">
        @csrf
        @method('PUT')
        @include('bookings._form')
        <button type="submit">Update</button>
    </form>
@endsection
