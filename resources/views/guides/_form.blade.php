@if($errors->any())
    <ul class="error-list">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

@isset($guide)
    <p>Guide ID: <strong>{{ $guide->guide_id }}</strong></p>
@else
    Guide ID (e.g. G004):<br>
    <input type="text" name="guide_id" id="guide_id" value="{{ old('guide_id') }}"><br><br>
@endisset

Name:<br>
<input type="text" name="name" id="name" value="{{ old('name', $guide->name ?? '') }}"><br><br>

Phone:<br>
<input type="text" name="phone" id="phone" value="{{ old('phone', $guide->phone ?? '') }}"><br><br>

Experience (years):<br>
<input type="number" name="experience_years" id="experience_years" min="0" max="60"
       value="{{ old('experience_years', $guide->experience_years ?? 0) }}"><br><br>

@push('scripts')
<script>
    function validateGuide() {
        const id = document.getElementById('guide_id');
        if (id && id.value.trim() === '') { alert("Guide ID is required!"); return false; }

        if (document.getElementById('name').value.trim() === '') {
            alert("Name is required!"); return false;
        }
        if (document.getElementById('phone').value.trim() === '') {
            alert("Phone is required!"); return false;
        }

        const years = document.getElementById('experience_years').value;
        if (years === '' || isNaN(years) || years < 0) {
            alert("Experience must be 0 or more!"); return false;
        }
        return true;
    }
</script>
@endpush
