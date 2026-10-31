@extends('layout.app')
@section('content')
    <h1>Register</h1>

    @if($errors->any())
        <ul class="error-list">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('register') }}" onsubmit="return validateRegister()">
        @csrf
        Full Name:<br>
        <input type="text" name="name" id="name" value="{{ old('name') }}"><br><br>

        Email:<br>
        <input type="email" name="email" id="email" value="{{ old('email') }}"><br><br>

        Password (min 8 characters):<br>
        <input type="password" name="password" id="password"><br><br>

        Confirm Password:<br>
        <input type="password" name="password_confirmation" id="password_confirmation"><br><br>

        <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>
@endsection

@push('scripts')
<script>
    function validateRegister() {
        if (document.getElementById('name').value.trim() === '') { alert("Name is required!"); return false; }
        if (document.getElementById('email').value.trim() === '') { alert("Email is required!"); return false; }
        const p1 = document.getElementById('password').value;
        const p2 = document.getElementById('password_confirmation').value;
        if (p1.length < 8) { alert("Password must be at least 8 characters!"); return false; }
        if (p1 !== p2) { alert("Passwords do not match!"); return false; }
        return true;
    }
</script>
@endpush