let colors = {
    red: "#ff0000",
    blue: "#0000ff",
    yellow: "#ffff00"
}

let data = {
    labels: ['12:33', '12:45', '13:50', '15:05', '16:07', '16:55', '20:01'],
    datasets: [
        {
            backgroundColor: colors.red,
            borderColor: colors.red,
            fill: false,
            steppedLine: true,
            data: [
                5,
                10,
                20,
                35,
                50,
                55,
                57
            ],
        }, 
    ]
}

let options = {
    responsive: true,
    title: {
        text: 'Chart.js Line Chart - Logarithmic'
    },
    scales: {
        xAxes: [{
            display: true,
        }],
        yAxes: [{
            display: true,
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