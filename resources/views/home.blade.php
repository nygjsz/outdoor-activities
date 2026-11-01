@extends('layout.app')

@section('hero')
    <header class="hero">
        <img src="{{ asset('image/banner.jpg') }}" alt="Hiker walking">
        <div class="hero-text">
            <h1>Find your next trail.</h1>
            <p>Browse hikes, kayaking, camping trips and more, then book with a local guide.</p>
            <a class="btn" href="{{ url('/activities') }}">Browse activities</a>
        </div>
    </header>
@endsection

@section('content')
    <h2 class="first">Upcoming activities</h2>
    @if($featured->isEmpty())
        <p>No activities available yet.</p>
    @else
        <div class="cards">
            @foreach($featured as $activity)
                <div class="card">
                    <h3>{{ $activity->name }}</h3>
                    <p>{{ $activity->location }}</p>
                    <p>{{ $activity->activity_date }}</p>
                    <div class="card-foot">
                        <span class="price">RM{{ $activity->price }}</span>
                        <a class="btn" href="{{ route('activities.show', $activity) }}">View</a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection