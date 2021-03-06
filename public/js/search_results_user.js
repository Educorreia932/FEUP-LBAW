let slider = document.getElementById("rating-range-slider")

var inputs = [
    document.getElementById('input-number-left'),
    document.getElementById('input-number-right')
];

noUiSlider.create(slider, {
    start: [inputs[0].value, inputs[1].value],
    connect: true,
    range: {
        'min': [0, 1],
        'max': [5000]
    },
});

slider.noUiSlider.on('update', function (values, handle) {
    inputs[handle].value = values[handle];
});

inputs[0].addEventListener('change', function () {
    slider.noUiSlider.set([this.value, null]);
});

inputs[1].addEventListener('change', function () {
    slider.noUiSlider.set([null, this.value]);
});

