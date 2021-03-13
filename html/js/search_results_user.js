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

let follow_buttons = document.querySelectorAll('.follow');

follow_buttons.forEach(follow_button => {
    follow_button.addEventListener('click', function () {
        let icon = follow_button.querySelector('i');
        let text = follow_button.querySelector('span');
        if (follow_button.classList.contains('btn-outline-danger')) {
            follow_button.classList.replace('btn-outline-danger', 'btn-danger');
            icon.classList.replace('bi-heart', 'bi-heart-fill');
            
            text.innerHTML = "Following";
        } else {
            follow_button.classList.replace('btn-danger', 'btn-outline-danger');
            icon.classList.replace('bi-heart-fill', 'bi-heart');
    
            text.innerHTML = "Follow";
        }
    })
});
