<div class="form-check @if(isset($master) && $master) master @endif">
    <input class="form-check-input" name="filter_check_{{ $group }}[]" type="checkbox"
    id="filter_check_{{ $group . $value }}" value="{{ $value }}"
    @if ($request->has('filter_check_' . $group))
        @if (in_array($value, $request->input('filter_check_' . $group)))
        checked
        @endif
    @else
        @if (isset($default) && $default)
        checked
        @endif
    @endif
    >
    <label class="form-check-label" for="filter_check_{{ $group . $value }}">
        {{ $name }}
    </label>
</div>
