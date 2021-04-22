function filter_radio($label, $name, $id, $checked = false, $disabled = false) { ?>

    <div class="form-check">
        <input class="form-check-input" type="radio" name="<?= $name ?>" id="<?= $id ?>" <?= $checked ? "checked" : "" ?> <?= $disabled ? "disabled" : "" ?>>
        <label class="form-check-label" for="<?= $id ?>">
            <?= $label ?>
        </label>
    </div>
