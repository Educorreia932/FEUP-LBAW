<div class="form-check @if(isset($master) && $master) master @endif">
    <input class="form-check-input" name="filter_check_{{ $group }}[]" type="checkbox"
    id="filter_check_{{ $group . $value }}" value="{{ $value }}"

    @if ($state)
        checked
    @else
        @if (isset($default))
            checked
        @endif
    @endif
    >
    
    <label class="form-check-label" for="filter_check_{{ $group . $value }}">
        {{ $name }}
    </label>
</div>
