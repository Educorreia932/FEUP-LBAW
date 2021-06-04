<div class="form-check @if(isset($master) && $master) master @endif">
    <input class="{{"check_".$value }}" id="filter_check_{{ $value . "_" . $id }}" name="filter_check_{{ $group }}[]" type="checkbox" value="{{ $value }}"

    @if (isset($disabled) && $disabled)
        disabled
    @endif

    @if ($state)
        checked
    @endif
    >
    
    <label class="form-check-label" for="filter_check_{{ $value . "_" . $id }}">
        {{ $name }}
    </label>
</div>
