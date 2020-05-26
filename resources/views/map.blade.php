<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <style>#map { min-height: 500px;} </style>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="/js/app.js" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="/css/app.css" rel="stylesheet">

        <!-- Leaflet (JS/CSS) -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
        <!-- Leaflet- KMZ -->
        <script src="https://unpkg.com/leaflet-kmz@latest/dist/leaflet-kmz.js"></script>

        <style>
		html, body {
			height: 100%;
			margin: 0;
		}
		#map {
			
		}
	</style>

	<style>
        #map {  }
        .info { padding: 6px 8px; font: 14px/16px Arial, Helvetica, sans-serif; background: white; background: rgba(255,255,255,0.8); box-shadow: 0 0 15px rgba(0,0,0,0.2); border-radius: 5px; } .info h4 { margin: 0 0 5px; color: #777; }
        .legend { text-align: left; line-height: 18px; color: #555; } .legend i { width: 50px; height: 18px; float: left; margin-right: 8px; opacity: 0.7; }
    </style>
    </head>

    <body>
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="{{ route('map') }}">
                        {{ config('app.name') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('map')}}">{{ __('Peta')}}</a>
                            </li>

                            @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('district.index')}}">{{ __('Data Kabupaten')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('report.index')}}">{{ __('Data Laporan')}}</a>
                            </li>
                            @endauth
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>

            <main class="py-4">
                <div class="container">

                    <div class="row justify-content-center mb-2">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <p class="font-weight-bold mb-0">Tanggal Laporan</p>
                                </div>
                                <div class="card-body">
                                    <form method="GET" action="{{route('map')}}">
                                        <label for="show_date" class="col-form-label">Tanggal Laporan</label>
                                        <input type="date" class="form-control mb-1" name="date" value="{{ $date }}"/>

                                        <button type="submit" class="btn btn-primary mb-0 float-right">
                                            Cari
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center mb-2">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <p class="font-weight-bold mb-0">Data Kasus Positif untuk {{$date_show}}</p>
                                </div>
                                <div class="card-body">
                                    <table class="table table-stripped">
                                        <thead class="thead-primary">
                                            <tr role="row">
                                                <th rowspan="1" colspan="1" class="text-center">Kabupaten</th>
                                                <th rowspan="1" colspan="6" class="text-center">Positif</th>
                                                <th rowspan="1" colspan="1" class="text-center">Dirawat</th>
                                                <th rowspan="1" colspan="1" class="text-center">Sembuh</th>
                                                <th rowspan="1" colspan="1" class="text-center">Meninggal</th>
                                            </tr>
                                            <tr role="row">
                                                <th rowspan="1" colspan="1">&nbsp;</th>
                                                <th rowspan="1" colspan="2" class="text-center">PPLN</th>
                                                <th rowspan="1" colspan="1" class="text-center">PPDN</th>
                                                <th rowspan="1" colspan="1" class="text-center">Transmisi Lokal</th>
                                                <th rowspan="1" colspan="1" class="text-center">Positif Lainnya</th>
                                                <th rowspan="1" colspan="1" class="text-center">Total Positif</th>
                                                <th rowspan="1" colspan="1">&nbsp;</th>
                                                <th rowspan="1" colspan="1">&nbsp;</th>
                                                <th rowspan="1" colspan="1">&nbsp;</th>
                                            </tr>
                                            <tr role="row">
                                                <th rowspan="1" colspan="1">&nbsp;</th>
                                                <th rowspan="1" colspan="1" class="text-center">WNA</th>
                                                <th rowspan="1" colspan="1" class="text-center">WNI</th>
                                                <th rowspan="1" colspan="1">&nbsp;</th>
                                                <th rowspan="1" colspan="1">&nbsp;</th>
                                                <th rowspan="1" colspan="1">&nbsp;</th>
                                                <th rowspan="1" colspan="1">&nbsp;</th>
                                                <th rowspan="1" colspan="1">&nbsp;</th>
                                                <th rowspan="1" colspan="1">&nbsp;</th>
                                                <th rowspan="1" colspan="1">&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 1; ?>
                                            @foreach($reports as $report)
                                            <tr>
                                                <td class="text-center">{{$report->district_name}}</td>
                                                <td class="text-center">{{$report->foreign_travel_agent_foreign}}</td>
                                                <td class="text-center">{{$report->foreign_travel_agent_indonesian}}</td>
                                                <td class="text-center">{{$report->domestic_travel_agent}}</td>
                                                <td class="text-center">{{$report->local_transmission}}</td>
                                                <td class="text-center">{{$report->other_positive}}</td>
                                                <td class="text-center">{{$report->total_positive}}</td>
                                                <td class="text-center">{{$report->treated}}</td>
                                                <td class="text-center">{{$report->recovered}}</td>
                                                <td class="text-center">{{$report->died}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <p class="font-weight-bold mb-0">Peta Sebaran Kasus Positif untuk {{$date_show}}</p>
                                </div>
                                <div class="card-body">
                                    <div id="map">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

        <script type="text/javascript" src="/js/bali-seperated-live.js"></script>

        <script type="text/javascript">
            // Insert Total Positive
            

            // Map
            var map = L.map('map').setView([-8.4560705, 115.1118982], 10);

            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                maxZoom: 18,
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                    '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                    'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                id: 'mapbox/light-v9',
                tileSize: 512,
                zoomOffset: -1
            }).addTo(map);


            // control that shows state info on hover
            var info = L.control();

            info.onAdd = function (map) {
                this._div = L.DomUtil.create('div', 'info');
                this.update();
                return this._div;
            };

            info.update = function (props) {
                this._div.innerHTML = '<h4>Kasus Positif COVID-19</h4>' +  (props ?
                    '<b>' + props.name + '</b><br />' + 'Total ' + props.total + ' kasus positif'
                    : 'Letakkan kursor di atas kabupaten');
            };

            info.addTo(map);


            // get color depending on population density value
            function getColor(d) {
                return d > 80 ? '#BF2300' :
                        d > 50  ? '#A33820' :
                        d > 30  ? '#884E41' :
                        d > 20  ? '#6D6362' :
                        d > 10   ? '#517982' :
                        d > 5   ? '#368EA3' :
                        d > 1   ? '#1BA4C4' :
                                    '#00BAE5';
            }

            function style(feature) {
                return {
                    weight: 2,
                    opacity: 1,
                    color: 'white',
                    dashArray: '3',
                    fillOpacity: 0.7,
                    fillColor: getColor(feature.properties.total)
                };
            }

            function highlightFeature(e) {
                var layer = e.target;

                layer.setStyle({
                    weight: 5,
                    color: '#666',
                    dashArray: '',
                    fillOpacity: 0.7
                });

                if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
                    layer.bringToFront();
                }

                info.update(layer.feature.properties);
            }

            var geojson;

            function resetHighlight(e) {
                geojson.resetStyle(e.target);
                info.update();
            }

            function zoomToFeature(e) {
                map.fitBounds(e.target.getBounds());
            }

            function onEachFeature(feature, layer) {
                layer.on({
                    mouseover: highlightFeature,
                    mouseout: resetHighlight,
                    click: zoomToFeature
                });
            }

            geojson = L.geoJson(statesData, {
                style: style,
                onEachFeature: onEachFeature
            }).addTo(map);

            // map.attributionControl.addAttribution('Population data &copy; <a href="http://census.gov/">US Census Bureau</a>');


            var legend = L.control({position: 'bottomright'});

            legend.onAdd = function (map) {

                var div = L.DomUtil.create('div', 'info legend'),
                    grades = [0, 1, 5, 10, 20, 30, 50, 80],
                    labels = [],
                    from, to;

                for (var i = 0; i < grades.length; i++) {
                    from = grades[i];
                    to = grades[i + 1];

                    labels.push(
                        '<i style="background:' + getColor(from + 1) + '"></i> ' +
                        from + (to ? '&ndash;' + to : '+'));
                }

                div.innerHTML = labels.join('<br>');
                return div;
            };

            legend.addTo(map);

        </script>
    </body>
</html>