if (typeof charts === 'object') {
    charts.forEach(function (chart) {
        renderChart(chart);
    });
} else {
    console.log('Please define charts variable properly');
}

function renderChart(chart) {
    var options = getOptions(chart, chart.type);
    var chartElement = new ApexCharts(document.querySelector('#' + chart.target), options);
    chartElement.render();
}

function getToolbarOptions() {
    return {
        show: true,
        tools: {
            download: true
        },
        export: {
            csv: {
                filename: 'chart-data',
                columnDelimiter: ',',
                headerCategory: 'category',
                headerValue: 'value',
                dateFormatter(timestamp) {
                    return new Date(timestamp).toDateString()
                }
            },
            png: {
                filename: 'chart-image',
            }
        }
    };
}

function getOptions(chart, type) {
    switch (type) {
        case 'bar':
            return {
                title: {
                    text: chart.title,
                    align: 'center'
                },
                series: [{
                    data: chart.data,
                    name: chart.name
                }],
                chart: {
                    type: 'bar',
                    height: 350,
                    toolbar: getToolbarOptions()
                },
                plotOptions: {
                    bar: {
                        borderRadius: 4,
                        horizontal: true,
                    }
                },
                colors: ['#153e7a'],
                dataLabels: {
                    enabled: false
                },
                xaxis: {
                    categories: chart.labels,
                }
            };
        case 'donut':
            return {
                title: {
                    text: chart.title,
                    align: 'center',
                    margin: 0,
                },
                series: chart.data,
                chart: {
                    type: 'donut',
                    toolbar: getToolbarOptions()
                },
                theme: {
                    monochrome: {
                        enabled: true,
                        color: '#557fbc',
                        shadeTo: 'dark',
                        shadeIntensity: 0.65
                    }
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom',
                            horizontalAlign: 'left',
                        }
                    }
                }],
                labels: chart.labels,
            };
        case 'area':
            return {
                chart: {
                    id: chart.target,
                    type: 'area',
                    height: 160,
                    sparkline: {
                        enabled: true
                    },
                    toolbar: getToolbarOptions()
                },
                stroke: {
                    curve: 'straight'
                },
                fill: {
                    opacity: 1,
                },
                series: [{
                    name: chart.name,
                    data: chart.data
                }],
                labels: chart.labels,
                xaxis: {
                    type: 'string',
                },
                yaxis: {
                    min: 0
                },
                colors: ['#153e7a'],
                title: {
                    text: chart.title,
                    offsetX: 0,
                    style: {
                        fontSize: '40px',
                        cssClass: 'apexcharts-yaxis-title'
                    }
                },
                subtitle: {
                    text: chart.name,
                    offsetX: 0,
                    offsetY: 50,
                    style: {
                        fontSize: '20px',
                        cssClass: 'apexcharts-yaxis-title'
                    }
                }
            };
        default:
            return {};
    }
}
