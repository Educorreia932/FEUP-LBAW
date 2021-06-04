let slider = document.getElementById("price-range-slider")

let inputs = [
    document.getElementById('input-number-left'),
    document.getElementById('input-number-right')
];

noUiSlider.create(slider, {
    start: [inputs[0].value, inputs[1].value],
    connect: true,
    range: {
        'min': [0],
        '50%': [50],
        '65%': [200],
        '85%': [500],
        'max': [2000]
    }
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

// Auction Owner Radio
let input_text = document.getElementById("radio-owner-user-input");
let input_radio_div = document.getElementById("auction-owner-radios");

input_radio_div.addEventListener('change', function(e) {
    let target = e.target;
    switch (target.id) {
        case 'radio-owner-user':
            input_text.disabled = false;
            break;

        case 'radio-owner-user-input':
            break;

        default:
            input_text.disabled = true;
            break;
    }
});

