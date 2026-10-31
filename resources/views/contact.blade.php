@extends('layout.app')
@section('content')
    <h1>Contact Us</h1>
    <p>Email: info@outdoor.test</p>
    <p>Phone: 07-123 4567</p>

    <h2>Send us a message</h2>

    @if($errors->any())
        <ul class="error-list">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('contact.send') }}" onsubmit="return validateContact()">
        @csrf
        Name:<br>
        <input type="text" name="name" id="name"
               value="{{ old('name', auth()->user()->name ?? '') }}"><br><br>

        Email:<br>
        <input type="text" name="email" id="email"
               value="{{ old('email', auth()->user()->email ?? '') }}"><br><br>

        Message:<br>
        <textarea name="message" id="message" rows="5">{{ old('message') }}</textarea><br><br>

        <button type="submit">Send</button>
    </form>
@endsection

@push('scripts')
<script>
    function validateContact() {
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const message = document.getElementById('message').value.trim();

        if (name === '') { alert("Name is required!"); return false; }

        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) { alert("Please enter a valid email!"); return false; }

        if (message.length < 10) { alert("Message must be at least 10 characters!"); return false; }

        return true;
    }
</script>
@endpush
