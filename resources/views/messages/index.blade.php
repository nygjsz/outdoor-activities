@extends('layout.app')
@section('content')
    <h1>Contact Messages</h1>

    @if($messages->isEmpty())
        <p>No messages yet.</p>
    @else
        <table>
            <tr>
                <th>DATE</th>
                <th>NAME</th>
                <th>EMAIL</th>
                <th>MESSAGE</th>
            </tr>
            @foreach($messages as $msg)
                <tr>
                    <td>{{ $msg->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $msg->name }}</td>
                    <td>{{ $msg->email }}</td>
                    <td>{{ $msg->message }}</td>
                </tr>
            @endforeach
        </table>
    @endif
@endsection
