@extends('layout.app')
@section('content')
    <h1>{{ $activity->name }}</h1>
    <p><strong>Code:</strong> {{ $activity->code }}</p>
    <p><strong>Location:</strong> {{ $activity->location }}</p>
    <p><strong>Date:</strong> {{ $activity->activity_date }}</p>
    <p><strong>Price:</strong> RM{{ $activity->price }}</p>
    <p><strong>Difficulty:</strong> {{ $activity->difficulty }}</p>
    <p><strong>Guide:</strong> {{ $activity->guide->name ?? 'Not assigned' }}</p>
    <p>{{ $activity->description }}</p>

    @auth
        <a class="btn" href="{{ route('bookings.create', ['activity' => $activity->code]) }}">Book this activity</a>
    @else
        <a class="btn" href="{{ route('login') }}">Login to book</a>
    @endauth

    <a class="btn" href="{{ route('activities.index') }}">Back</a>
@endsection