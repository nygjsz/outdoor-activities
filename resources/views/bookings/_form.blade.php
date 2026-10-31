@if($errors->any())
    <ul class="error-list">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

@isset($booking)
    <p>Activity: <strong>{{ $booking->activity->name }}</strong> ({{ $booking->activity_code }})</p>
@else
    Activity:<br>
    <select name="activity_code" id="activity_code">
        <option value="">-- Choose an activity --</option>
        @foreach($activities as $activity)
            <option value="{{ $activity->code }}"
                {{ old('activity_code', $selected ?? '') == $activity->code ? 'selected' : '' }}>
                {{ $activity->name }} | {{ $activity->activity_date }} | RM{{ $activity->price }}
            </option>
        @endforeach
    </select><br><br>
@endisset

Number of participants:<br>
<input type="number" name="participants" id="participants" min="1" max="20"
       value="{{ old('participants', $booking->participants ?? 1) }}"><br><br>

Safety notes (allergies, medical conditions, experience level):<br>
<textarea name="safety_notes" rows="3">{{ old('safety_notes', $booking->safety_notes ?? '') }}</textarea><br><br>

@isset($booking)
    @if(auth()->user()->role === 'admin')
        Status:<br>
        <select name="status">
            @foreach(['pending', 'confirmed', 'cancelled'] as $s)
                <option value="{{ $s }}" {{ old('status', $booking->status) == $s ? 'selected' : '' }}>
                    {{ ucfirst($s) }}
                </option>
            @endforeach
        </select><br><br>
    @endif
@endisset

@push('scripts')
<script>
    function validateBooking() {
        const activity = document.getElementById('activity_code');
        if (activity && activity.value === '') {
            alert("Please choose an activity!");
            return false;
        }
        const people = document.getElementById('participants').value;
        if (people === '' || isNaN(people) || people < 1) {
            alert("Participants must be at least 1!");
            return false;
        }
        return true;
    }
</script>
@endpush
