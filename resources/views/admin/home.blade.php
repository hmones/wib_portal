@extends('layouts.auth')

@section('content')
    <div class="ui center aligned container">
        <div class="ui stackable grid">
            <div class="five wide column">
                <div id="chart"></div>
                <div id="chart3"></div>
            </div>
            <div class="eleven wide column">
                <div id="chart2"></div>
            </div>
        </div>

        <div class="ui left aligned basic very padded segment">
            <table class="ui stackable table">
                <tr>
                    <td class="one wide">
                        <i class="users blue icon"></i>
                    </td>
                    <td class="thirteen wide">
                        Registered Users
                    </td>
                    <td class="three wide">
                        <div class="ui basic fluid center aligned label">{{$users}}</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <i class="blue building icon"></i>
                    </td>
                    <td>
                        Registered Businesses/Organizations
                    </td>
                    <td>
                        <div class="ui basic fluid center aligned label">{{$entities}}</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <i class="blue tasks icon"></i>
                    </td>
                    <td>
                        Entity Types Supported by the Platform
                    </td>
                    <td>
                        <div class="ui basic fluid center aligned label">{{$entityTypes}}</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <i class="blue folder icon"></i>
                    </td>
                    <td>
                        Sectors Supported by the Platform
                    </td>
                    <td>
                        <div class="ui basic fluid center aligned label">{{$sectors}}</div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        var options = {
            chart: {
                type: 'line'
            },
            series: [{
                name: 'sales',
                data: [30, 40, 35, 50, 49, 60, 70, 91, 125]
            }],
            xaxis: {
                categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998, 1999]
            }
        }

        var chart = new ApexCharts(document.querySelector("#chart"), options);

        chart.render();
    </script>
    <script>
        var options = {
            chart: {
                type: 'line'
            },
            series: [{
                name: 'sales',
                data: [30, 40, 35, 50, 49, 60, 70, 91, 125]
            }],
            xaxis: {
                categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998, 1999]
            }
        }

        var chart = new ApexCharts(document.querySelector("#chart2"), options);

        chart.render();
    </script>
    <script>
        var options = {
            chart: {
                type: 'line'
            },
            series: [{
                name: 'sales',
                data: [30, 40, 35, 50, 49, 60, 70, 91, 125]
            }],
            xaxis: {
                categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998, 1999]
            }
        }

        var chart = new ApexCharts(document.querySelector("#chart3"), options);

        chart.render();
    </script>
@endsection
