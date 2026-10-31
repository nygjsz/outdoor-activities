@if($errors->any())
    <ul class="error-list">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

@isset($activity)
    <p>Code: <strong>{{ $activity->code }}</strong></p>
@else
    Activity Code:<br>
    <input type="text" name="code" id="code" value="{{ old('code') }}"><br><br>
@endisset

Name:<br>
<input type="text" name="name" id="name" value="{{ old('name', $activity->name ?? '') }}"><br><br>

Location:<br>
<input type="text" name="location" id="location" value="{{ old('location', $activity->location ?? '') }}"><br><br>

Description:<br>
<textarea name="description" rows="3">{{ old('description', $activity->description ?? '') }}</textarea><br><br>

Price (RM):<br>
<input type="text" name="price" id="price" value="{{ old('price', $activity->price ?? '') }}"><br><br>

Date:<br>
<input type="date" name="activity_date" value="{{ old('activity_date', $activity->activity_date ?? '') }}"><br><br>

Difficulty:<br>
<select name="difficulty">
    @foreach(['Easy', 'Moderate', 'Hard'] as $level)
        <option value="{{ $level }}"
            {{ old('difficulty', $activity->difficulty ?? '') == $level ? 'selected' : '' }}>
            {{ $level }}
        </option>
    @endforeach
</select><br><br>

Guide:<br>
<select name="guide_id">
    <option value="">-- No guide --</option>
    @foreach($guides as $guide)
        <option value="{{ $guide->guide_id }}"
            {{ old('guide_id', $activity->guide_id ?? '') == $guide->guide_id ? 'selected' : '' }}>
            {{ $guide->name }}
        </option>
    @endforeach
</select><br><br>