let colors = {
    red: "#ff0000",
    blue: "#0000ff"
}

let data = {
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    datasets: [
        {
            label: 'My First dataset',
            backgroundColor: colors.red,
            borderColor: colors.red,
            fill: false,
            steppedLine: true,
            data: [
                5,
                10,
                20,
                30,
                45,
                55
            ],
        }, 
    ]
}

let options = {
    responsive: true,
    title: {
        display: true,
        text: 'Chart.js Line Chart - Logarithmic'
    },
    scales: {
        xAxes: [{
            display: true,
        }],
        yAxes: [{
            display: true,
            type: 'logarithmic',
        }]
    },
}

let config = {
    type: "line",
    data: data,
    options: options
}

let ctx = document.getElementById("bid-history-chart").getContext('2d');

window.bidHistoryChart = new Chart(ctx, config);