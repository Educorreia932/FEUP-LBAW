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

// let inputs = [
//     document.getElementById('input-number-left'),
//     document.getElementById('input-number-right')
// ];

// slider.noUiSlider.on('update', function (values, handle) {
//     inputs[handle].value = values[handle];
// });

// inputs[0].addEventListener('change', function () {
//     slider.noUiSlider.set([this.value, null]);
// });

// inputs[1].addEventListener('change', function () {
//     slider.noUiSlider.set([null, this.value]);
// });

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

