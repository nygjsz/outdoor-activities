@extends('layout.app')
@section('content')
    <h1>Activities</h1>

    @if($activities->isEmpty())
        <p>No activities found.</p>
    @else
        <button onclick="toggleDetails()">Show / Hide</button><br><br>

        <div id="activityList">
            <table>
                <tr>
                    <th>CODE</th><th>NAME</th><th>LOCATION</th><th>DATE</th>
                    <th>PRICE (RM)</th><th>LEVEL</th><th>GUIDE</th><th>ACTION</th>
                </tr>
                @foreach($activities as $activity)
                    <tr>
                        <td>{{ $activity->code }}</td>
                        <td>{{ $activity->name }}</td>
                        <td>{{ $activity->location }}</td>
                        <td>{{ $activity->activity_date }}</td>
                        <td>{{ $activity->price }}</td>
                        <td>{{ $activity->difficulty }}</td>
                        <td>{{ $activity->guide->name ?? 'Not assigned' }}</td>
                        <td>
                            <a class="btn" href="{{ route('activities.show', $activity) }}">View</a>

                            @auth
                                @if(auth()->user()->role === 'admin')
                                    <a class="btn" href="{{ route('activities.edit', $activity) }}">Edit</a>
                                    <form action="{{ route('activities.destroy', $activity) }}" method="POST"
                                            class="inline" onsubmit="return confirm('Delete this activity?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-danger">Delete</button>
                                    </form>
                                @endif
                            @endauth
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    @endif
@endsection

@push('scripts')
<script>
    function toggleDetails() {
        let section = document.getElementById("activityList");
        section.style.display = section.style.display === "none" ? "block" : "none";
    }
</script>
@endpush