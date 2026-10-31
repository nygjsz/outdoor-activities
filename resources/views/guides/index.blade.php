@extends('layout.app')
@section('content')
    <h1>Guides</h1>

    <a class="btn" href="{{ route('guides.create') }}">+ Add Guide</a>

    <form action="{{ route('guides.index') }}" method="GET" style="margin:14px 0;">
        <input type="text" name="search" placeholder="Search guide..." value="{{ request('search') }}">
        <button type="submit">Search</button>
    </form>

    @if($guides->isEmpty())
        <p>No guides found.</p>
    @else
        <table>
            <tr>
                <th>ID</th>
                <th>NAME</th>
                <th>PHONE</th>
                <th>EXPERIENCE (YEARS)</th>
                <th>ACTIVITIES</th>
                <th>ACTION</th>
            </tr>
            @foreach($guides as $guide)
                <tr>
                    <td>{{ $guide->guide_id }}</td>
                    <td>{{ $guide->name }}</td>
                    <td>{{ $guide->phone }}</td>
                    <td>{{ $guide->experience_years }}</td>
                    <td>{{ $guide->activities_count }}</td>
                    <td>
                        <a class="btn" href="{{ route('guides.edit', $guide) }}">Edit</a>
                        <form action="{{ route('guides.destroy', $guide) }}" method="POST"
                              class="inline"
                              onsubmit="return confirm('Delete this guide? Their activities will become unassigned.')">
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
