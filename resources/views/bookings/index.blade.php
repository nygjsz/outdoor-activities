@extends('layout.app')
@section('content')
    <h1>{{ auth()->user()->role === 'admin' ? 'All Bookings' : 'My Bookings' }}</h1>
    <a class="btn" href="{{ route('bookings.create') }}">+ New Booking</a><br><br>

    @if($bookings->isEmpty())
        <p>No bookings yet.</p>
    @else
        <table>
            <tr>
                <th>NO.</th>
                @if(auth()->user()->role === 'admin')
                    <th>CUSTOMER</th>
                @endif
                <th>ACTIVITY</th>
                <th>DATE</th>
                <th>PEOPLE</th>
                <th>TOTAL (RM)</th>
                <th>SAFETY NOTES</th>
                <th>STATUS</th>
                <th>ACTION</th>
            </tr>
            @foreach($bookings as $booking)
                <tr>
                    <td>{{ $booking->id }}</td>
                    @if(auth()->user()->role === 'admin')
                        <td>{{ $booking->user->name }}</td>
                    @endif
                    <td>{{ $booking->activity->name }}</td>
                    <td>{{ $booking->activity->activity_date }}</td>
                    <td>{{ $booking->participants }}</td>
                    <td>{{ number_format($booking->participants * $booking->activity->price, 2) }}</td>
                    <td>{{ $booking->safety_notes ?? '-' }}</td>
                    <td><span class="status status-{{ strtolower($booking->status) }}">{{ ucfirst($booking->status) }}</span></td>
                    <td>
                        <a class="btn" href="{{ route('bookings.edit', $booking) }}">Edit</a>
                        <form action="{{ route('bookings.destroy', $booking) }}" method="POST"
                            class="inline" onsubmit="return confirm('Delete this booking?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    @endif
@endsection
