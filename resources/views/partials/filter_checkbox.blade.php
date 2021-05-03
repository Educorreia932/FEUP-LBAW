<div class="form-check @if(isset($master) && $master) master @endif">
    <input class="form-check-input" type="checkbox" id={{ $id }} @if (isset($checked) && $checked) checked @endif>
    <label class="form-check-label" for={{ $id }}>
        {{ $name }}
    </label>
</div>
