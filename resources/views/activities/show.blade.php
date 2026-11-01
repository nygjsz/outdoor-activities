@extends('layout.app')
@section('content')
    <h1>{{ $activity->name }}</h1>

    <dl class="facts">
        <div><dt>Code</dt><dd>{{ $activity->code }}</dd></div>
        <div><dt>Location</dt><dd>{{ $activity->location }}</dd></div>
        <div><dt>Date</dt><dd>{{ $activity->activity_date }}</dd></div>
        <div><dt>Price</dt><dd class="price">RM{{ $activity->price }}</dd></div>
        <div><dt>Difficulty</dt><dd><span class="level level-{{ strtolower($activity->difficulty) }}">{{ $activity->difficulty }}</span></dd></div>
        <div><dt>Guide</dt><dd>{{ $activity->guide->name ?? 'Not assigned' }}</dd></div>
    </dl>

    <p>{{ $activity->description }}</p>

    @auth
        <a class="btn" href="{{ route('bookings.create', ['activity' => $activity->code]) }}">Book this activity</a>
    @else
        <a class="btn" href="{{ route('login') }}">Login to book</a>
    @endauth

    <a class="btn btn-ghost" href="{{ route('activities.index') }}">Back</a>
@endsection