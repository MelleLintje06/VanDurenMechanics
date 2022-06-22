<x-app-layout>
    @include('layouts/head')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Van Duren Mechanics') }}
        </h2>
    </x-slot>
    <link rel="stylesheet" href="/styles.css">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div id="GA_Chart" style="width:100%; height: 400px;"></div>
                    <div id="P_Chart" style="width:100%; height: 400px;"></div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    google.charts.load('current',{packages:['corechart']});
    google.charts.setOnLoadCallback(GA_Chart);

    function GA_Chart() {
        // Set Data
        var data = google.visualization.arrayToDataTable([
            ['Datum', 'Bezoekers'],
            ['05-03-22',7],
            ['06-03-22',8],
            ['07-03-22',8],
            ['08-03-22',9],
            ['09-03-22',9],
            ['10-03-22',9],
            ['11-03-22',10],
            ['12-03-22',11],
            ['13-03-22',14],
            ['14-03-22',14],
            ['15-03-22',15]
        ]);
        // Set Options
        var options = {
            title: 'Google Analytics',
            hAxis: {title: 'Datum'},
            vAxis: {title: 'Bezoekers'},
            legend: 'none'
        };
        // Draw
        var chart = new google.visualization.LineChart(document.getElementById('GA_Chart'));
        chart.draw(data, options);
    }

    google.charts.setOnLoadCallback(P_Chart);
    function P_Chart() {
        // Set Data
        var data = google.visualization.arrayToDataTable([
            ['Datum', 'Bezoekers'],
            ['05-03-22',3],
            ['06-03-22',6],
            ['07-03-22',7],
            ['08-03-22',7],
            ['09-03-22',6],
            ['10-03-22',8],
            ['11-03-22',10],
            ['12-03-22',11],
            ['13-03-22',14],
            ['14-03-22',13],
            ['15-03-22',12]
        ]);
        // Set Options
        var options = {
            title: 'Producten bezocht',
            hAxis: {title: 'Datum'},
            vAxis: {title: 'Bezoekers'},
            legend: 'none'
        };
        // Draw
        var chart = new google.visualization.LineChart(document.getElementById('P_Chart'));
        chart.draw(data, options);
    }
</script>
