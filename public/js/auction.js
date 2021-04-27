let colors = {
    line: "#0D6EFD",
    points: "#0A2FB3",
    yellow: "#ffff00"
}

let data = {
    labels: ['26/02 00:00', '03/03 12:45', '3/03 13:50', '03/03 15:05', '3/03 16:07', '3/03 16:55', '3/03 17:50', '3/03 19:00', '3/03 20:23'],
    datasets: [
        {
            backgroundColor: colors.points,
            borderColor: colors.line,
            fill: false,
            data: [
                75,
                90,
                105,
                120,
                135,
                150,
                165,
                180
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
    legend: {
        display: false
    },
}

let config = {
    type: "line",
    data: data,
    options: options
}

let ctx = document.getElementById("bid-history-chart").getContext('2d');

window.bidHistoryChart = new Chart(ctx, config);
