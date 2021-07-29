@extends('layouts.auth')

@section('content')
    <div class="ui container">
        <h2 class="ui blue header">Statistics in the last 7 days</h2>
    </div>
    <br><br>
    <div class="ui center aligned container">
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
        <div class="ui stackable grid">
            <div class="eight wide column">
                <div id="entitiesRevenue" class="ui basic segment"></div>
            </div>
            <div class="eight wide column">
                <div id="entitiesType" class="ui basic segment"></div>
            </div>
        </div>
        <div class="ui stackable grid">
            <div class="eight wide column">
                <div id="entitiesTurnover" class="ui basic segment"></div>
            </div>
            <div class="eight wide column">
                <div id="entitiesSize" class="ui basic segment"></div>
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
    <style>
        div.apexcharts-legend-series {
            text-align: left !important;
        }
    </style>
    <script>
        var charts = [
            {
                'type': 'area',
                'target': 'activeUsers',
                'title': {{ last(data_get($activeUsers, 'data')) ?? '0' }},
                'data': [{{ implode(',',  data_get($activeUsers, 'data', [])) }}],
                'name': 'Active Users',
                'labels': [`{!! implode('`,`',  data_get($activeUsers, 'days', [])) !!}`],
            },
            {
                'type': 'area',
                'target': 'registeredUsers',
                'title': {{ last(data_get($registeredUsers, 'data')) ?? '0' }},
                'data': [{{ implode(',',  data_get($registeredUsers, 'data', [])) }}],
                'name': 'Registered Users',
                'labels': [`{!! implode('`,`',  data_get($registeredUsers, 'days', [])) !!}`],
            },
            {
                'type': 'area',
                'target': 'registeredEntities',
                'title': {{ last(data_get($registeredEntities, 'data')) ?? '0' }},
                'data': [{{ implode(',',  data_get($registeredEntities, 'data', [])) }}],
                'name': 'Registered Entities',
                'labels': [`{!! implode('`,`',  data_get($registeredEntities, 'days', [])) !!}`]
            },
            {
                'type': 'bar',
                'target': 'usersCountries',
                'title': 'Users of top 10 countries',
                'data': [{{ implode(',', data_get($usersCountries, 'data')) }}],
                'name': 'Users',
                'labels': [`{!! implode('`,`', data_get($usersCountries, 'labels', [])) !!}`]
            },
            {
                'type': 'donut',
                'target': 'usersAge',
                'title': 'Users by Age',
                'name': 'Users',
                'data': [{{ implode(',', data_get($usersAge, 'data')) }}],
                'labels': [`{!! implode('`,`', data_get($usersAge, 'age', [])) !!}`]
            },
            {
                'type': 'donut',
                'target': 'entitiesTypes',
                'title': 'Entities by Type',
                'name': 'Entities',
                'data': [{{ implode(',', data_get($entitiesTypes, 'data')) }}],
                'labels': [`{!! implode('`,`', data_get($entitiesTypes, 'labels', [])) !!}`]
            },
            {
                'type': 'bar',
                'target': 'usersSectors',
                'title': 'Users for top 10 sectors',
                'name': 'Users',
                'data': [{{ implode(',', data_get($usersSectors, 'data')) }}],
                'labels': [`{!! implode('`,`', data_get($usersSectors, 'labels', [])) !!}`]
            },
            {
                'type': 'bar',
                'target': 'entitiesSectors',
                'title': 'Entities for top 10 sectors',
                'name': 'Entities',
                'data': [{{ implode(',', data_get($entitiesSectors, 'data')) }}],
                'labels': [`{!! implode('`,`', data_get($entitiesSectors, 'labels', [])) !!}`]
            },
            {
                'type': 'donut',
                'target': 'entitiesRevenue',
                'title': 'Entities by Revenue',
                'name': 'Entities',
                'data': [{{ implode(',', data_get($entitiesRevenue, 'data')) }}],
                'labels': [`{!! implode('`,`', data_get($entitiesRevenue, 'labels', [])) !!}`]
            },
            {
                'type': 'donut',
                'target': 'entitiesType',
                'title': 'Entities by Business Type',
                'name': 'Entities',
                'data': [{{ implode(',', data_get($entitiesType, 'data')) }}],
                'labels': [`{!! implode('`,`', data_get($entitiesType, 'labels', [])) !!}`]
            },
            {
                'type': 'donut',
                'target': 'entitiesSize',
                'title': 'Entities by Size',
                'name': 'Entities',
                'data': [{{ implode(',', data_get($entitiesSize, 'data')) }}],
                'labels': [`{!! implode('`,`', data_get($entitiesSize, 'labels', [])) !!}`]
            },
            {
                'type': 'donut',
                'target': 'entitiesTurnover',
                'title': 'Entities by Turnover',
                'name': 'Entities',
                'data': [{{ implode(',', data_get($entitiesTurnover, 'data')) }}],
                'labels': [`{!! implode('`,`', data_get($entitiesTurnover, 'labels', [])) !!}`]
            },

        ];
    </script>
    <script src="{{asset('js/adminDashboard.js')}}"></script>
@endsection
