@extends('layout.app')
@section('content')
    <h1>Add New Activity</h1>
    <form method="POST" action="{{ route('activities.store') }}" onsubmit="return validateForm()">
        @csrf
        @include('activities._form')
        <button type="submit">Save</button>
    </form>
@endsection

@push('scripts')
<script>
    function validateForm() {
        const name = document.getElementById('name').value.trim();
        const price = document.getElementById('price').value;
        if (name === '') { alert("Name is required!"); return false; }
        if (isNaN(price) || price <= 0) { alert("Invalid price!"); return false; }
        return true;
    }
</script>
@endpush