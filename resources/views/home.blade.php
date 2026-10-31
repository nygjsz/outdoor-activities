@extends('layout.app')
@section('content')
    <h1>Welcome to Adventure &amp; Outdoor Activities</h1>
    <p>Hiking, kayaking, camping and more. Pick an activity and book your next adventure.</p>

    <h2>Upcoming Activities</h2>
    @if($featured->isEmpty())
        <p>No activities available yet.</p>
    @else
        <div class="cards">
            @foreach($featured as $activity)
                <div class="card">
                    <h3>{{ $activity->name }}</h3>
                    <p>{{ $activity->location }}</p>
                    <p>{{ $activity->activity_date }} &middot; RM{{ $activity->price }}</p>
                    <a class="btn" href="{{ route('activities.show', $activity) }}">View</a>
                </div>
            @endforeach
        </div>
    @endif
@endsection