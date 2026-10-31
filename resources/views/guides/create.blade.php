@extends('layout.app')
@section('content')
    <h1>Add New Guide</h1>
    <form method="POST" action="{{ route('guides.store') }}" onsubmit="return validateGuide()">
        @csrf
        @include('guides._form')
        <button type="submit">Save</button>
    </form>
@endsection
