@extends('layout.app')
@section('content')
    <h1>Edit Guide</h1>
    <form method="POST" action="{{ route('guides.update', $guide) }}" onsubmit="return validateGuide()">
        @csrf
        @method('PUT')
        @include('guides._form')
        <button type="submit">Update</button>
    </form>
@endsection
