@extends('layout.app')
@section('content')
    <h1>Login</h1>

    @if($errors->any())
        <ul class="error-list">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('login') }}" onsubmit="return validateLogin()">
        @csrf
        Email:<br>
        <input type="email" name="email" id="email" value="{{ old('email') }}"><br><br>

        Password:<br>
        <input type="password" name="password" id="password"><br><br>

        <button type="submit">Login</button>

    </form>
    <p>No account yet? <a href="{{ route('register') }}">Register here</a></p>
@endsection

@push('scripts')
<script>
    function validateLogin() {
        if (document.getElementById('email').value.trim() === '') { alert("Email is required!"); return false; }
        if (document.getElementById('password').value === '') { alert("Password is required!"); return false; }
        return true;
    }
</script>
@endpush