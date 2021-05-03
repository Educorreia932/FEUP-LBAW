let slider = document.getElementById("rating-range-slider")

noUiSlider.create(slider, {
    start: [0, 100],
    connect: true,
    range: {
        'min': [0, 1],
        'max': [100, 1]
    },
});


var inputs = [
    document.getElementById('input-number-left'),
    document.getElementById('input-number-right')
];

slider.noUiSlider.on('update', function (values, handle) {
    inputs[handle].value = values[handle];
});

inputs[0].addEventListener('change', function () {
    slider.noUiSlider.set([this.value, null]);
});

inputs[1].addEventListener('change', function () {
    slider.noUiSlider.set([null, this.value]);
});
