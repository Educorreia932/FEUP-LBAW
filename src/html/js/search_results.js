let slider = document.getElementById("price-range-slider")

noUiSlider.create(slider, {
    start: [0, 500],
    connect: true,
    range: {
        // Starting at 500, step the value by 500,
        // until 4000 is reached. From there, step by 1000.
        'min': [0, 1],
        '25%': [50, 5],
        '50%': [200, 50],
        '65%': [500, 100],
        '80%': [1000, 1000],
        '95%': [10000, 10000],
        'max': [100000]
    },
});


var inputs = [
    document.getElementById('input-number-left'),
    document.getElementById('input-number-right')
];

slider.noUiSlider.on('update', function (values, handle) {
    inputs[handle].value = values[handle];
});

inputNumber.addEventListener('change', function () {
    html5Slider.noUiSlider.set([null, this.value]);
});

