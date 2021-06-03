let chart_elem = document.getElementById("bid-history-chart");
if (chart_elem != null) {
    let ctx = chart_elem.getContext('2d');

    let bid_values = []
    let bid_timestamps = []

    document.getElementById('chart-data').querySelectorAll('li').forEach(li => {
        bid_values.push(li.getAttribute('bid_value') / 100);
        bid_timestamps.push(li.getAttribute('bid_timestamp') * 1000);
    });

    let colors = {
        line: "#6618DA",
        points: "#4c07b5"
    }

    let data = {
        labels: bid_timestamps,
        datasets: [
            {
                label: 'Bid',
                backgroundColor: colors.points,
                borderColor: colors.line,
                fill: false,
                data: bid_values
            },
        ]
    }

    let options = {
        responsive: true,
        plugins: {
            title: {
                display: false,
                text: 'Bidding History Chart'
            },
            legend: {
                display: false
            },
            tooltip: {
                callbacks: {
                    title: context => {return new Date(context[0].parsed.x).toLocaleTimeString(undefined, {year: '2-digit', month:'short', day:'numeric'});},
                    label: function(context) {
                        let label = context.dataset.label || '';
                        if (label)
                            label += ': ';
                        if (context.parsed.y !== null)
                            label += 'φ ' + context.parsed.y.toFixed(2);
                        return label;
                    }
                }
            }
        },
        interaction: {
            mode: 'nearest',
            intersect: false
        },
        scales: {
            x: {
                display: true,
                type: 'linear',
                title: {
                    display: true,
                    text: 'Time',
                },
                ticks: {
                    source: 'auto',
                    callback: function(value, index, values) {
                        return new Date(value).toLocaleTimeString(undefined, {month:'short', day:'numeric'})
                    }
                }
            },
            y: {
                display: true,
                type: 'linear',
                title: {
                    display: true,
                    text: 'Value'
                },
                ticks: {
                    // Include a dollar sign in the ticks
                    callback: function(value, index, values) {
                        return value + 'φ';
                    }
                },
            },
        },
    }

    let config = {
        type: "line",
        data: data,
        options: options
    }

    window.bidHistoryChart = new Chart(ctx, config);
}
