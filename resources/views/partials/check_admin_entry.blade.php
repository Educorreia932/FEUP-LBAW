<div class="form-check @if(isset($master) && $master) master @endif">
    <input class="form-check-input" name="filter_check_{{ $group }}[]" type="checkbox"
    id="filter_check_{{ $group . "_" . $value }}" value="{{ $value }}"

    @if (isset($disabled) && $disabled)
        disabled
    @endif

    @if ($state)
        checked
    @endif
    >
    
    <label class="form-check-label" for="filter_check_{{ $group . "_" . $value }}">
        {{ $name }}
    </label>
</div>
