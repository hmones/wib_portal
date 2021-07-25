@extends('layouts.auth')

@section('content')
    <div class="ui center aligned container">
        <div class="ui header">Statistics in the last 7 days</div>
        <div class="ui stackable grid">
            <div class="five wide column">
                <div id="activeUsers" class="ui basic segment"></div>
            </div>
            <div class="six wide column">
                <div id="registeredUsers" class="ui basic segment"></div>
            </div>
            <div class="five wide column">
                <div id="registeredEntities" class="ui basic segment"></div>
            </div>
        </div>
        <div class="ui stackable grid">
            <div class="sixteen wide column">
                <div id="usersCountries" class="ui basic segment"></div>
            </div>
        </div>
        <div class="ui stackable grid">
            <div class="eight wide column">
                <div id="usersAge" class="ui basic segment"></div>
            </div>
            <div class="eight wide column">
                <div id="entitiesTypes" class="ui basic segment"></div>
            </div>
        </div>
        <div class="ui stackable grid">
            <div class="eight wide column">
                <div id="usersSectors" class="ui basic segment"></div>
            </div>
            <div class="eight wide column">
                <div id="entitiesSectors" class="ui basic segment"></div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.27.3/apexcharts.min.js"
            integrity="sha512-nKTh1Ik8Kzbrxo9A6xOBtEbzdNYcjI4Pr5XE88sNJQk87sY8mBlUfh61lYm0i710r5mGcIZ9tWSwORQbQ4plQQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.27.3/apexcharts.min.css"
          integrity="sha512-Tv+8HvG00Few62pkPxSs1WVfPf9Hft4U1nMD6WxLxJzlY/SLhfUPFPP6rovEmo4zBgwxMsArU6EkF11fLKT8IQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <script>
        var options = {
            chart: {
                id: 'activeUsers',
                group: 'sparklines',
                type: 'area',
                height: 160,
                sparkline: {
                    enabled: true
                },
            },
            stroke: {
                curve: 'straight'
            },
            fill: {
                opacity: 1,
            },
            series: [{
                name: 'Active Users',
                data: [{{ implode(',',  data_get($activeUsers, 'data', [])) }}]
            }],
            labels: [`{{ implode('`,`',  data_get($activeUsers, 'days', [])) }}`],
            xaxis: {
                type: 'string',
            },
            yaxis: {
                min: 0
            },
            colors: ['#153e7a'],
            title: {
                text: {{ last(data_get($activeUsers, 'data')) ?? '0' }},
                offsetX: 0,
                style: {
                    fontSize: '40px',
                    cssClass: 'apexcharts-yaxis-title'
                }
            },
            subtitle: {
                text: 'Active Users',
                offsetX: 0,
                offsetY: 50,
                style: {
                    fontSize: '20px',
                    cssClass: 'apexcharts-yaxis-title'
                }
            }
        }

        var chart = new ApexCharts(document.querySelector("#activeUsers"), options);

        chart.render();
    </script>
    <script>
        var options = {
            chart: {
                id: 'registeredUsers',
                group: 'sparklines',
                type: 'area',
                height: 160,
                sparkline: {
                    enabled: true
                },
            },
            stroke: {
                curve: 'straight'
            },
            fill: {
                opacity: 1,
            },
            series: [{
                name: 'Registered Users',
                data: [{{ implode(',',  data_get($registeredUsers, 'data', [])) }}]
            }],
            labels: [`{{ implode('`,`',  data_get($registeredUsers, 'days', [])) }}`],
            xaxis: {
                type: 'string',
            },
            yaxis: {
                min: 0
            },
            colors: ['#153e7a'],
            title: {
                text: {{ last(data_get($registeredUsers, 'data')) ?? '0' }},
                offsetX: 0,
                style: {
                    fontSize: '40px',
                    cssClass: 'apexcharts-yaxis-title'
                }
            },
            subtitle: {
                text: 'Registered Users',
                offsetX: 0,
                offsetY: 50,
                style: {
                    fontSize: '20px',
                    cssClass: 'apexcharts-yaxis-title'
                }
            }
        }

        var chart = new ApexCharts(document.querySelector("#registeredUsers"), options);

        chart.render();
    </script>
    <script>
        var options = {
            chart: {
                id: 'registeredEntities',
                group: 'sparklines',
                type: 'area',
                height: 160,
                sparkline: {
                    enabled: true
                },
            },
            stroke: {
                curve: 'straight'
            },
            fill: {
                opacity: 1,
            },
            series: [{
                name: 'Registered Entities',
                data: [{{ implode(',',  data_get($registeredEntities, 'data', [])) }}]
            }],
            labels: [`{{ implode('`,`',  data_get($registeredEntities, 'days', [])) }}`],
            xaxis: {
                type: 'string',
            },
            yaxis: {
                min: 0
            },
            colors: ['#153e7a'],
            title: {
                text: {{ last(data_get($registeredEntities, 'data')) ?? '0' }},
                offsetX: 0,
                style: {
                    fontSize: '40px',
                    cssClass: 'apexcharts-yaxis-title'
                }
            },
            subtitle: {
                text: 'Registered Entities',
                offsetX: 0,
                offsetY: 50,
                style: {
                    fontSize: '20px',
                    cssClass: 'apexcharts-yaxis-title'
                }
            }
        }

        var chart = new ApexCharts(document.querySelector("#registeredEntities"), options);

        chart.render();
    </script>
    <script>
        var options = {
            title: {
                text: 'Users of top 10 countries',
                align: 'center'
            },
            series: [{
                data: [{{implode(',', data_get($usersCountries, 'data'))}}],
                name: 'Users'
            }],
            chart: {
                type: 'bar',
                height: 350
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
                categories: [`{{implode('`,`', data_get($usersCountries, 'labels', []))}}`],
            }
        };

        var chart = new ApexCharts(document.querySelector("#usersCountries"), options);

        chart.render();
    </script>
    <script>
        var options = {
            title: {
                text: 'Users by Age',
                align: 'center',
                margin: 0,
            },
            series: [{{implode(',', data_get($usersAge, 'data'))}}],
            chart: {
                type: 'donut'
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }],
            labels: [`{{implode('`,`', data_get($usersAge, 'age', []))}}`],

        };

        var chart = new ApexCharts(document.querySelector("#usersAge"), options);

        chart.render();
    </script>
    <script>
        var options = {
            title: {
                text: 'Entities by Type',
                align: 'center'
            },
            series: [{{implode(',', data_get($entitiesTypes, 'data'))}}],
            chart: {
                type: 'donut'
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }],
            labels: [`{{implode('`,`', data_get($entitiesTypes, 'labels', []))}}`],

        };

        var chart = new ApexCharts(document.querySelector("#entitiesTypes"), options);

        chart.render();
    </script>
    <script>
        var options = {
            title: {
                text: 'Users for top 10 sectors',
                align: 'center'
            },
            series: [{
                data: [{{implode(',', data_get($usersSectors, 'data'))}}],
                name: 'Users'
            }],
            chart: {
                type: 'bar',
                height: 350
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
                categories: [`{{implode('`,`', data_get($usersSectors, 'labels', []))}}`],
            }
        };

        var chart = new ApexCharts(document.querySelector("#usersSectors"), options);

        chart.render();
    </script>
    <script>
        var options = {
            title: {
                text: 'Entities for top 10 sectors',
                align: 'center'
            },
            series: [{
                data: [{{implode(',', data_get($entitiesSectors, 'data'))}}],
                name: 'Entities'
            }],
            chart: {
                type: 'bar',
                height: 350
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
                categories: [`{{implode('`,`', data_get($entitiesSectors, 'labels', []))}}`],
            }
        };

        var chart = new ApexCharts(document.querySelector("#entitiesSectors"), options);

        chart.render();
    </script>
@endsection
