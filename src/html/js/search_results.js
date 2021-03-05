let slider = document.getElementById("price-range-slider")

noUiSlider.create(slider, {
    start: [20, 100],
    connect: true,
    range: {
        min: 20,
        max: 100
    },
    tooltips: true
});
